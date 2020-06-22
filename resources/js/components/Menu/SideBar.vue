<template>
    <div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <router-link to="/" class="brand-link">
                <img src="img/MCU.png"
                     alt="MCU Logo"
                     class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">Ticketing System</span>
            </router-link>
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <router-link to="/" class="d-block">"NAME HERE"</router-link>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-flat nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-header">
                            MICT
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name: 'Test'}"
                                         class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <h1>Sample Text</h1>
        </aside>
    </div>
</template>

<script>
    export default {
        name: 'SideBar'
    }
</script>
