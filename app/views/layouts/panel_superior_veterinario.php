<div class="barra-navegacion-superior">
    <div class="navegacion-izquierda">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-heart text-danger"></i>
            <span class="fw-semibold">Dashboards</span>
            <span class="text-muted">/</span>
            <span>Por defecto</span>
        </div>
    </div>
    <div class="buscador-navegacion">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search" class="form-control">
    </div>
    <div class="acciones-navegacion">
        <!-- Dentro de .acciones-navegacion -->
        <button class="boton-icono-navegacion" onclick="toggleTheme()">
            <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
        </button>
        <button class="boton-icono-navegacion">
            <i class="bi bi-arrow-counterclockwise"></i>
        </button>
        <button class="boton-icono-navegacion">
            <a href="dashBoardPerfil.html"><i class="bi bi-person-circle"></i></a>
        </button>
        <button class="boton-icono-navegacion" onclick="alternarBarraDerecha()">
            <i class="bi bi-chevron-left"></i>
        </button>
    </div>
</div>