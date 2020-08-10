<template>
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard" />
        <p>
          {{ $t('home_page') }}
          <i class="right fa fa-angle-left" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <nuxt-link :to="{ name: 'service-providers' }" class="nav-link active">
            <i class="fa fa-circle-o nav-icon" />
            <p>{{ $t('service_providers') }}</p>
          </nuxt-link>
        </li>
        <li class="nav-item">
          <nuxt-link :to="{ name: 'orders' }" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p> الطلبات</p>
          </nuxt-link>
        </li>
        <li class="nav-item">
          <a href="./index3.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>داشبورد سوم</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="pages/widgets.html" class="nav-link">
        <i class="nav-icon fa fa-th" />
        <p>
          ویجت‌ها
          <span class="right badge badge-danger">جدید</span>
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-pie-chart" />
        <p>
          چارت‌ها
          <i class="right fa fa-angle-left" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/charts/chartjs.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>نمودار ChartJS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/charts/flot.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>نمودار Flot</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/charts/inline.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>نمودار Inline</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-tree" />
        <p>
          اشیای گرافیکی
          <i class="fa fa-angle-left right" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/UI/general.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>عمومی</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/UI/icons.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>آیکون‌ها</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/UI/buttons.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>دکمه‌ها</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/UI/sliders.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>اسلایدر‌ها</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-edit" />
        <p>
          فرم‌ها
          <i class="fa fa-angle-left right" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/forms/general.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>اجزا عمومی</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/forms/advanced.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>پیشرفته</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/forms/editors.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>ویشرایشگر</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-table" />
        <p>
          جداول
          <i class="fa fa-angle-left right" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/tables/simple.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>جداول ساده</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/tables/data.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>جداول داده</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-header">
      مثال‌ها
    </li>
    <li class="nav-item">
      <a href="pages/calendar.html" class="nav-link">
        <i class="nav-icon fa fa-calendar" />
        <p>
          تقویم
          <span class="badge badge-info right">۲</span>
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-envelope-o" />
        <p>
          ایمیل‌ باکس
          <i class="fa fa-angle-left right" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/mailbox/mailbox.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>اینباکس</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/mailbox/compose.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>ایجاد</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/mailbox/read-mail.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>خواندن</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-book" />
        <p>
          صفحات
          <i class="fa fa-angle-left right" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/examples/invoice.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>سفارشات</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/examples/profile.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>پروفایل</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/examples/login.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>صفحه ورود</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/examples/register.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>صفحه عضویت</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/examples/lockscreen.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>قفل صفحه</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-plus-square-o" />
        <p>
          بیشتر
          <i class="fa fa-angle-left right" />
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="pages/examples/404.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>ارور ۴۰۴</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/examples/500.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>ارور ۵۰۰</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/examples/blank.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>صفحه خالی</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="starter.html" class="nav-link">
            <i class="fa fa-circle-o nav-icon" />
            <p>صفحه شروع</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-header">
      متفاوت
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-file" />
        <p>مستندات</p>
      </a>
    </li>
    <li class="nav-header">
      برچسب‌ها
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-circle-o text-danger" />
        <p class="text">مهم</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-circle-o text-warning" />
        <p>هشدار</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-circle-o text-info" />
        <p>اطلاعات</p>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'SidebarItems',
  data () {
    return {
      sliderArrow: 'right'
    }
  }
}
</script>

<style>

</style>
