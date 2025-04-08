<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BlueCare - Account Management</title>
  <style>
    * { box-sizing: border-box; font-family: system-ui, sans-serif; }
    body { margin: 0; display: flex; background-color: #f9f9f9; color: #222; }

    .sidebar {
      width: 220px;
      background-color: #fff;
      height: 100vh;
      border-right: 1px solid #eee;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 1rem 0;
    }

    .sidebar .logo {
      text-align: center;
      font-weight: bold;
      font-size: 1.2rem;
      padding: 1rem 0;
    }

    .sidebar nav a {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      color: #333;
      border-radius: 10px;
      margin: 5px 10px;
    }

    .sidebar nav a.active {
      background-color: #e9efff;
      color: #1e5eff;
      font-weight: bold;
    }

    .sidebar nav a:hover {
      background-color: #f0f4ff;
    }

    .sidebar .logout {
      padding: 1rem;
      text-align: center;
    }

    .logout button {
      background-color: #ffecec;
      color: #d00;
      padding: 10px 15px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }

    .main {
      flex-grow: 1;
      padding: 2rem;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .search-bar {
      flex-grow: 1;
      max-width: 400px;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .actions button {
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      cursor: pointer;
      background: #f3f3f3;
    }

    .new-task {
      background-color: #1e5eff;
      color: white;
    }

    h2 {
      margin: 2rem 0 1rem;
    }

    .card {
      background: white;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .table-container {
      margin-top: 2rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background-color: #f7f7f7;
      font-weight: bold;
    }

    tr:last-child td {
      border-bottom: none;
    }

    button.action-btn {
      background: transparent;
      border: none;
      cursor: pointer;
      margin-right: 10px;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.4);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      width: 100%;
      max-width: 400px;
    }

    .modal-content h3 {
      margin-top: 0;
    }

    .modal-content label {
      display: block;
      margin-top: 1rem;
    }

    .modal-content input, .modal-content select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .modal-actions {
      margin-top: 1.5rem;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn.cancel {
      background: #eee;
    }

    .btn.submit {
      background: #1e5eff;
      color: white;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <div class="logo">BlueCare<br>AgedCare</div>
      <nav>
        <a href="realtimemonitor.html">📡 Real Time Monitoring</a>
        <a href="dashboard.html">📊 Dashboard</a>
        <a href="#" class="active">📁 Account Management</a>
        <a href="booking-management.html">📅 Booking Management</a>
      </nav>
    </div>
    <div class="logout">
      <button>↩ Log out</button>
    </div>
  </div>

  <!-- Main -->
  <div class="main">
    <div class="header">
      <input type="text" class="search-bar" placeholder="Search accounts...">
      <div class="actions">
        <button>↩</button>
        <button>↪</button>
        <button>⚙️</button>
        <button class="new-task" onclick="openModal()">Add Account +</button>
      </div>
    </div>

    <h2>Account Management</h2>
    <div class="table-container">
      <table id="accountsTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="accountModal">
    <div class="modal-content">
      <h3 id="modalTitle">Add New Account</h3>
      <form id="accountForm">
        <label for="name">Full Name</label>
        <input type="text" id="name" required>
        <label for="email">Email</label>
        <input type="email" id="email" required>
        <label for="role">Role</label>
        <select id="role" required>
          <option value="">Select a role</option>
          <option value="Admin">Admin</option>
          <option value="Staff">Staff</option>
          <option value="Visitor">Visitor</option>
        </select>
        <div class="modal-actions">
          <button type="button" class="btn cancel" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn submit">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById("accountModal");
    const form = document.getElementById("accountForm");
    const tableBody = document.querySelector("#accountsTable tbody");
    const modalTitle = document.getElementById("modalTitle");

    let accounts = [];
    let editId = null;

    function openModal(isEdit = false) {
      modal.style.display = "flex";
      modalTitle.textContent = isEdit ? "Edit Account" : "Add New Account";
    }

    function closeModal() {
      modal.style.display = "none";
      form.reset();
      editId = null;
    }

    function renderTable() {
      tableBody.innerHTML = "";
      accounts.forEach((acc, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${acc.name}</td>
          <td>${acc.email}</td>
          <td>${acc.role}</td>
          <td>
            <button class="action-btn" onclick="editUser(${index})">✏️</button>
            <button class="action-btn" onclick="deleteUser(${index})">🗑</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    function editUser(index) {
      const acc = accounts[index];
      editId = index;
      document.getElementById("name").value = acc.name;
      document.getElementById("email").value = acc.email;
      document.getElementById("role").value = acc.role;
      openModal(true);
    }

    function deleteUser(index) {
      if (confirm("Delete this account?")) {
        accounts.splice(index, 1);
        renderTable(); 
      }
    }

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const role = document.getElementById("role").value;

      if (editId !== null) {
        accounts[editId] = { name, email, role };
      } else {
        accounts.push({ name, email, role });
      }

      renderTable();
      closeModal();
    });

    window.addEventListener("click", function (e) {
      if (e.target === modal) closeModal();
    });
  </script>
</body>
</html>
