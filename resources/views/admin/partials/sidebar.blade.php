<aside class="admin-sidebar">
  <div class="admin-brand">
    Sunugal Habitat
    <span>Back-office</span>
  </div>

  <nav class="admin-nav">
    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Produits</a>
    <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">Clients</a>
    <a href="{{ route('admin.invoices.index') }}" class="{{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">Factures</a>
    <a href="{{ route('admin.admins.index') }}" class="{{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">Admins</a>
    <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">Voir le site</a>
  </nav>

  <form method="POST" action="{{ route('admin.logout') }}" class="admin-logout">
    @csrf
    <button type="submit" class="btn btn-warning">Se deconnecter</button>
  </form>
</aside>
