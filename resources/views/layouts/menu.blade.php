<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Panel
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Charts
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>ChartJS</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Flot</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inline</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>uPlot</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-image"></i>
        <p>
            Gallery
        </p>
    </a>
</li>
@hasanyrole('SuperAdmin|Admin')
    <li class="nav-header">Administrador</li>
@endhasanyrole
<li class="nav-item">
    <a href="{{ route('month_data') }}" class="nav-link">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            Importar registros
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('pay_view') }}" class="nav-link">
        <i class="fas fa-money-bill-wave"></i>
        <p>
            Registrar Pagos
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('bills.index') }}" class="nav-link">
        <i class="fas fa-hand-holding-usd"></i>
        <p>
            Registrar Gastos
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('users.create') }}" class="nav-link">
        <i class="fas fa-user-plus"></i>
        <p>
            Registrar Usuarios
        </p>
    </a>
</li>
