const form = document.getElementById('person-form');
const statusEl = document.getElementById('status');
const listEl = document.getElementById('people-list');

function setStatus(msg, ok = true) {
  statusEl.textContent = msg;
  statusEl.className = ok ? 'status ok' : 'status error';
}

async function loadPeople() {
  const r = await fetch('api/people_list.php');
  const data = await r.json();
  if (!data.ok) {
    setStatus('Failed to load people.', false);
    return;
  }
  listEl.innerHTML = '';
  if (!data.people.length) {
    const li = document.createElement('li');
    li.textContent = 'No people yet.';
    listEl.appendChild(li);
    return;
  }
  data.people.forEach((p) => {
    const li = document.createElement('li');
    li.textContent = `${p.display_name} (${p.quadrant})${p.is_core ? ' • core' : ''}`;
    listEl.appendChild(li);
  });
}

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  setStatus('Saving...');
  const fd = new FormData(form);
  const r = await fetch('api/people_save.php', {
    method: 'POST',
    body: fd
  });
  const data = await r.json();
  if (!data.ok) {
    setStatus('Failed to save. Check required fields.', false);
    return;
  }
  form.reset();
  setStatus('Person added.');
  loadPeople();
});

loadPeople();
