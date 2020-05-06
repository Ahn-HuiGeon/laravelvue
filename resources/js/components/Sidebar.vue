<template>
    <ul class="sidebar navbar-nav">
        <li class="nav-item">
            <router-link to="/" class="nav-link" exact>
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>메인페이지</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/categories" class="nav-link" exact>
                <i class="fas fa-fw fa-chart-area"></i>
                <span>게시판</span>
            </router-link>
        </li>
    </ul>
</template>

<script>
export default {};
</script>

<style></style>
