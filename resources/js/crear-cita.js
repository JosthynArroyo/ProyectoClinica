(function () {
  const form  = document.querySelector('form[data-endpoint-template]');
  const espSel = document.getElementById('especialidad_id');
  const docSel = document.getElementById('doctor_id');
  const fecha  = document.getElementById('fecha');
  const hora   = document.getElementById('hora');

  const endpointTemplate = form?.dataset.endpointTemplate;
  const oldEsp = form?.dataset.oldEsp;
  const oldDoc = form?.dataset.oldDoc;

  async function loadDoctors(especialidadId, preselectId) {
    docSel.innerHTML = '<option value="">Cargando…</option>';
    docSel.disabled = true;

    if (!especialidadId) {
      docSel.innerHTML = '<option value="">Seleccione una especialidad primero</option>';
      return;
    }

    const url = endpointTemplate.replace('ESP_ID', encodeURIComponent(especialidadId));

    try {
      const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
      if (!res.ok) throw new Error('HTTP ' + res.status);

      const data = await res.json();
      if (!Array.isArray(data) || data.length === 0) {
        docSel.innerHTML = '<option value="">No hay doctores activos en esta especialidad</option>';
      } else {
        let opts = '<option value="">Seleccionar</option>';
        for (const d of data) {
          const sel = String(preselectId || '') === String(d.id) ? ' selected' : '';
          opts += `<option value="${d.id}"${sel}>${d.name}</option>`;
        }
        docSel.innerHTML = opts;
      }
      docSel.disabled = false;
    } catch (e) {
      console.error(e);
      docSel.innerHTML = '<option value="">Error cargando doctores</option>';
    }
  }

  function pad(n) { return String(n).padStart(2, '0'); }

  function updateMinTime() {
    try {
      if (!fecha.value) { hora.removeAttribute('min'); return; }
      const now = new Date();
      const chosen = new Date(fecha.value + 'T00:00:00');

      if (chosen.toDateString() === now.toDateString()) {
        const t = new Date(now.getTime() + 30 * 60000);
        const minVal = `${pad(t.getHours())}:${pad(t.getMinutes())}`;
        hora.min = minVal;
        if (hora.value && hora.value < minVal) hora.value = minVal;
      } else {
        hora.removeAttribute('min');
      }
    } catch (e) {}
  }

  fecha && fecha.addEventListener('change', updateMinTime);
  updateMinTime();

  espSel.addEventListener('change', function () { loadDoctors(this.value, null); });

  if (oldEsp) { loadDoctors(oldEsp, oldDoc); }
})();
