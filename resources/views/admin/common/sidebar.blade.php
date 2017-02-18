<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset("assets/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}" class="user-image" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i>Онлайн</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Интернет Магазин</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{route('index')}}"><i class="fa fa-link"></i> <span>Сайт</span></a></li>
            <li class="active"><a href="{{route('admin.index')}}"><i class="fa fa-tachometer"></i> <span>Админка</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-folder"></i> <span>Товары</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('product.index')}}">Добавить товар</a></li>
                    <li><a href="{{route('product.edit')}}">Редактировать товары</a></li>
                    <li><a href="{{route('product.export')}}">Экспорт/Иморт</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cubes"></i> <span>Категории</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('category.index')}}">Добавить категорию</a></li>
                    <li><a href="{{route('category.edit')}}">Редактировать категории</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-folder-open"></i> <span>Страницы</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('page.index')}}">Добавить новую</a></li>
                    <li><a href="{{route('page.edit')}}">Редактировать страницы</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-industry"></i> <span>Бренды</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('brand.index')}}">Добавить бренд</a></li>
                    <li><a href="{{route('brand.edit')}}">Редактировать бренды</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-picture-o"></i> <span>Изображения</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('image.index')}}">Добавить изображение</a></li>
                    <li><a href="{{route('image.edit')}}">Редактировать изображения</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-sliders"></i> <span>Слайдер</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('slider.index')}}">Добавить слайдер</a></li>
                    <li><a href="{{route('slider.edit')}}">Редактировать слайдер</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
