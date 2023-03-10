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
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            Registrar pago
        </p>
    </a>
</li>
