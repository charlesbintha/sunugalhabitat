<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Administration Sunugal Habitat')</title>
  <meta name="robots" content="noindex,nofollow,noarchive">
  <style>
    :root {
      --bg: #f4f6f8;
      --panel: #ffffff;
      --line: #d9dee5;
      --text: #12263f;
      --muted: #5b6b7f;
      --navy: #0f2f57;
      --gold: #d8b44a;
      --danger: #bf3f3f;
      --success: #2d7a54;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: var(--bg);
      color: var(--text);
    }
    a { color: inherit; text-decoration: none; }
    .admin-shell {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 280px 1fr;
    }
    .admin-sidebar {
      background: var(--navy);
      color: #fff;
      padding: 32px 24px;
    }
    .admin-brand {
      font-size: 22px;
      font-weight: 700;
      line-height: 1.3;
      margin-bottom: 28px;
    }
    .admin-brand span {
      color: var(--gold);
      display: block;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: .08em;
      text-transform: uppercase;
    }
    .admin-nav a {
      display: block;
      padding: 12px 14px;
      border-radius: 10px;
      margin-bottom: 8px;
      background: rgba(255,255,255,.06);
    }
    .admin-nav a.active {
      background: rgba(216,180,74,.2);
      border: 1px solid rgba(216,180,74,.35);
    }
    .admin-logout {
      margin-top: 24px;
    }
    .admin-logout button,
    .btn {
      border: none;
      border-radius: 10px;
      padding: 12px 16px;
      font: inherit;
      cursor: pointer;
    }
    .btn-primary { background: var(--navy); color: #fff; }
    .btn-secondary { background: #e9eef4; color: var(--text); }
    .btn-danger { background: var(--danger); color: #fff; }
    .btn-success { background: var(--success); color: #fff; }
    .btn-warning { background: var(--gold); color: var(--navy); }
    .admin-content {
      padding: 32px;
    }
    .admin-panel {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 18px 45px rgba(15,47,87,.06);
    }
    .admin-topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 24px;
    }
    .admin-title {
      margin: 0;
      font-size: 30px;
      line-height: 1.2;
    }
    .admin-subtitle {
      color: var(--muted);
      margin-top: 6px;
    }
    .flash {
      background: #ecf8f0;
      border: 1px solid #b8dfc5;
      color: #1f5b3c;
      border-radius: 12px;
      padding: 14px 16px;
      margin-bottom: 20px;
    }
    .errors {
      background: #fff1f1;
      border: 1px solid #e6b0b0;
      color: #7c2d2d;
      border-radius: 12px;
      padding: 14px 16px;
      margin-bottom: 20px;
    }
    .grid-2 {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 18px;
    }
    .grid-4 {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 18px;
    }
    .field {
      margin-bottom: 18px;
    }
    .field label {
      display: block;
      font-weight: 700;
      margin-bottom: 8px;
    }
    .field input,
    .field textarea,
    .field select {
      width: 100%;
      border: 1px solid var(--line);
      border-radius: 12px;
      padding: 12px 14px;
      font: inherit;
      background: #fff;
    }
    .field textarea {
      min-height: 130px;
      resize: vertical;
    }
    .hint {
      color: var(--muted);
      font-size: 13px;
      margin-top: 6px;
    }
    .checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 8px;
    }
    .checkbox input {
      width: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 14px 12px;
      border-bottom: 1px solid var(--line);
      text-align: left;
      vertical-align: top;
    }
    th {
      color: var(--muted);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: .04em;
    }
    .actions {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    .badge {
      display: inline-flex;
      align-items: center;
      border-radius: 999px;
      padding: 6px 10px;
      font-size: 12px;
      font-weight: 700;
    }
    .badge-active {
      background: #e7f7ee;
      color: #1f6a47;
    }
    .badge-inactive {
      background: #f5ecec;
      color: #8a3737;
    }
    .thumb {
      width: 90px;
      height: 66px;
      object-fit: cover;
      border-radius: 10px;
      border: 1px solid var(--line);
      background: #eef2f6;
    }
    .form-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: 10px;
    }
    .panel-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
      margin-bottom: 24px;
    }
    .metric-card {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 18px;
      padding: 20px;
      box-shadow: 0 18px 45px rgba(15,47,87,.06);
    }
    .metric-card strong {
      display: block;
      font-size: 28px;
      margin-top: 8px;
    }
    .info-list {
      display: grid;
      gap: 12px;
    }
    .info-row {
      display: grid;
      grid-template-columns: 180px 1fr;
      gap: 12px;
      padding-bottom: 12px;
      border-bottom: 1px solid var(--line);
    }
    .info-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }
    .info-label {
      color: var(--muted);
      font-weight: 700;
    }
    .stack {
      display: grid;
      gap: 18px;
    }
    .empty-state {
      padding: 22px;
      border: 1px dashed var(--line);
      border-radius: 14px;
      color: var(--muted);
      text-align: center;
    }
    .login-shell {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 24px;
      background:
        radial-gradient(circle at top right, rgba(216,180,74,.18), transparent 32%),
        linear-gradient(135deg, #0f2f57, #173f73 55%, #f4f6f8 55%);
    }
    .login-card {
      width: min(460px, 100%);
      background: rgba(255,255,255,.98);
      border-radius: 22px;
      padding: 32px;
      box-shadow: 0 25px 60px rgba(0,0,0,.18);
    }
    @media (max-width: 991px) {
      .admin-shell {
        grid-template-columns: 1fr;
      }
      .admin-content {
        padding: 20px;
      }
      .grid-2,
      .grid-4,
      .panel-grid,
      .info-row {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  @yield('body')
  @stack('scripts')
</body>
</html>
