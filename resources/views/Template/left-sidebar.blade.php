<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="brand-link">
        <!-- <img src="{{ asset('inventory.png') }}" width="30px;" alt="logo"> -->
        <span class="brand-text font-weight-bold" style="padding-top: 10px;">AMS</span>
    </div>

    <div class="sidebar-left">
        <nav class="">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <router-link to="/assets" class="nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Asset Listing
                        </p>
                    </router-link>
                </li>
                
                <li class="nav-item">
                    <router-link to="/import-csv" class="nav-link">
                        <i class="nav-icon fas fa-cloud-upload-alt"></i>
                        <p>
                            Import CSV
                        </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/components" class="nav-link">
                        <i class="nav-icon fas fa-microchip"></i>
                        <p>
                            Components
                        </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/brands" class="nav-link">
                        <i class="nav-icon fa-brands fa-buromobelexperte"></i>
                        <p>
                            Brands
                        </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/models" class="nav-link">
                        <i class="nav-icon fa-brands fa-bandcamp"></i>
                        <p>
                            Models
                        </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/skus" class="nav-link">
                        <i class="nav-icon fa-brands fa-product-hunt"></i>
                        <p>
                            SKU
                        </p>
                    </router-link>
                </li>
                
                <li class="nav-item">
                    <router-link to="/users" class="nav-link">
                        <i class="far fas fa-user-shield nav-icon"></i>
                        <p>Users</p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/customers" class="nav-link">
                        <i class="far fa-users nav-icon"></i>
                        <p>Customers</p>
                    </router-link>
                </li>
            </ul>
        </nav>
    </div>
</aside>