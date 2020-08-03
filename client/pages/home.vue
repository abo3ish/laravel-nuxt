<template>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">
                داشبورد
              </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item">
                  <a href="#">خانه</a>
                </li>
                <li class="breadcrumb-item active">
                  داشبورد ورژن 2
                </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>سفارشات جدید</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag" />
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <fa icon="arrow-circle-left" /></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>

                  <p>افزایش امتیاز</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars" />
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <fa icon="arrow-circle-left" /></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>کاربران ثبت شده</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add" />
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <fa icon="arrow-circle-left" /></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>بازدید جدید</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph" />
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <fa icon="arrow-circle-left" /></a>
              </div>
            </div>
          <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3">
                    <fa icon="pie-chart mr-1" />
                    فروش
                  </h3>
                  <ul class="nav nav-pills mr-auto p-2">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">نمودار</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">چارت</a>
                    </li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div id="revenue-chart" class="chart tab-pane active"
                         style="position: relative; height: 300px;"
                    />
                    <div id="sales-chart" class="chart tab-pane" style="position: relative; height: 300px;" />
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- DIRECT CHAT -->
              <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                  <h3 class="card-title">
                    گفتگو
                  </h3>

                  <div class="card-tools">
                    <span data-toggle="tooltip" title="3 پیام جدید" class="badge badge-primary">3</span>
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                      <fa icon="minus" />
                    </button>
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="مخاصبین"
                            data-widget="chat-pane-toggle"
                    >
                      <fa icon="comments" />
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                      <fa icon="times" />
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name float-left">حسام موسوی</span>
                        <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        واقعا این قالب رایگانه ؟ قابل باور نیست
                      </div>
                    <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name float-right">سارا</span>
                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        بهتره اینو باور کنی :)
                      </div>
                    <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name float-left">حسام موسوی</span>
                        <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        میخوام با این قالب یه اپلیکیشن باحال بزنم ؟‌ تو هم همکاری میکنی ؟
                      </div>
                    <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name float-right">سارا</span>
                        <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        اره حتما
                      </div>
                    <!-- /.direct-chat-text -->
                    </div>
                  <!-- /.direct-chat-msg -->
                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user1-128x128.jpg">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              حسام موسوی
                              <small class="contacts-list-date float-left">1397/10/01</small>
                            </span>
                            <span class="contacts-list-msg">تا حالا کجا بودی ؟‌من...</span>
                          </div>
                        <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user7-128x128.jpg">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              سارا فرهانی
                              <small class="contacts-list-date float-left">2/23/2015</small>
                            </span>
                            <span class="contacts-list-msg">تا حالا منتظر تو بودم...</span>
                          </div>
                        <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user3-128x128.jpg">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              نکیسا کیانی
                              <small class="contacts-list-date float-left">2/20/2015</small>
                            </span>
                            <span class="contacts-list-msg">پس بیشتر صبر کن تا برگردم...</span>
                          </div>
                        <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user5-128x128.jpg">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              رحمت موسوی
                              <small class="contacts-list-date float-left">2/10/2015</small>
                            </span>
                            <span class="contacts-list-msg"> حالتون چطورههههه !...</span>
                          </div>
                        <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user6-128x128.jpg">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              جکسون عبداللهی
                              <small class="contacts-list-date float-left">1/27/2015</small>
                            </span>
                            <span class="contacts-list-msg">عالیییییییییی...</span>
                          </div>
                        <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user8-128x128.jpg">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              کتایون ریحانی
                              <small class="contacts-list-date float-left">1/4/2015</small>
                            </span>
                            <span class="contacts-list-msg">بیخیالش پیداش میکنم...</span>
                          </div>
                        <!-- /.contacts-list-info -->
                        </a>
                      </li>
                    <!-- End Contact Item -->
                    </ul>
                  <!-- /.contacts-list -->
                  </div>
                <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-primary">Send</button>
                      </span>
                    </div>
                  </form>
                </div>
              <!-- /.card-footer-->
              </div>
              <!--/.direct-chat -->

              <!-- TO DO List -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1" />
                    لیست کارها
                  </h3>

                  <div class="card-tools">
                    <ul class="pagination pagination-sm">
                      <li class="page-item">
                        <a href="#" class="page-link">&laquo;</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">1</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">2</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">3</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">&raquo;</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <ul class="todo-list">
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <fa icon="ellipsis-v" />
                        <fa icon="ellipsis-v" />
                      </span>
                      <!-- checkbox -->
                      <input type="checkbox" value="" name="">
                      <!-- todo text -->
                      <span class="text">طراحی یک قالب زیبا</span>
                      <!-- Emphasis label -->
                      <small class="badge badge-danger"><fa icon="clock-o" /> 2 دقیقه</small>
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <fa icon="edit" />
                        <fa icon="trash-o" />
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <fa icon="ellipsis-v" />
                        <fa icon="ellipsis-v" />
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">رسپانسیو کردن قالب مورد نظر</span>
                      <small class="badge badge-info"><fa icon="clock-o" /> 4 ساعت</small>
                      <div class="tools">
                        <fa icon="edit" />
                        <fa icon="trash-o" />
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <fa icon="ellipsis-v" />
                        <fa icon="ellipsis-v" />
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">ارائه قالب برای استفاده بقیه</span>
                      <small class="badge badge-warning"><fa icon="clock-o" /> 1 روز</small>
                      <div class="tools">
                        <fa icon="edit" />
                        <fa icon="trash-o" />
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <fa icon="ellipsis-v" />
                        <fa icon="ellipsis-v" />
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">بهینه سازی بخش های بوجود اومده</span>
                      <small class="badge badge-success"><fa icon="clock-o" /> 3 روز</small>
                      <div class="tools">
                        <fa icon="edit" />
                        <fa icon="trash-o" />
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <fa icon="ellipsis-v" />
                        <fa icon="ellipsis-v" />
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">چک کردن پیام ها و نوتیفیکیشن ها</span>
                      <small class="badge badge-primary"><fa icon="clock-o" /> 1 هفته</small>
                      <div class="tools">
                        <fa icon="edit" />
                        <fa icon="trash-o" />
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <fa icon="ellipsis-v" />
                        <fa icon="ellipsis-v" />
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">طراحی صفحه ایمیل جدید</span>
                      <small class="badge badge-secondary"><fa icon="clock-o" /> 1 ماه</small>
                      <div class="tools">
                        <fa icon="edit" />
                        <fa icon="trash-o" />
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <button type="button" class="btn btn-info float-right">
                    <fa icon="plus" /> جدید
                  </button>
                </div>
              </div>
            <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <!-- Map card -->
              <div class="card bg-primary-gradient">
                <div class="card-header no-border">
                  <h3 class="card-title">
                    <fa icon="map-marker mr-1" />
                    بازدید‌ها
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button"
                            class="btn btn-primary btn-sm daterange"
                            data-toggle="tooltip"
                            title="Date range"
                    >
                      <fa icon="calendar" />
                    </button>
                    <button type="button"
                            class="btn btn-primary btn-sm"
                            data-widget="collapse"
                            data-toggle="tooltip"
                            title="Collapse"
                    >
                      <fa icon="minus" />
                    </button>
                  </div>
                <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div id="world-map" style="height: 250px; width: 100%;" />
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1" />
                      <div class="text-white">
                        بازدید‌ها
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2" />
                      <div class="text-white">
                        آنلاین
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3" />
                      <div class="text-white">
                        فروش
                      </div>
                    </div>
                  <!-- ./col -->
                  </div>
                <!-- /.row -->
                </div>
              </div>
              <!-- /.card -->

              <!-- solid sales graph -->
              <div class="card bg-info-gradient">
                <div class="card-header no-border">
                  <h3 class="card-title">
                    <fa icon="th mr-1" />
                    نمودار فروش
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-widget="collapse">
                      <fa icon="minus" />
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-widget="remove">
                      <fa icon="times" />
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div id="line-chart" class="chart" style="height: 250px;" />
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                             data-fgColor="#39CCCC"
                      >

                      <div class="text-white">
                        سفارش ایمیلی
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                             data-fgColor="#39CCCC"
                      >

                      <div class="text-white">
                        سفارش آنلاین
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                             data-fgColor="#39CCCC"
                      >

                      <div class="text-white">
                        سفارش فیزیکی
                      </div>
                    </div>
                  <!-- ./col -->
                  </div>
                <!-- /.row -->
                </div>
              <!-- /.card-footer -->
              </div>
              <!-- /.card -->

              <!-- Calendar -->
              <div class="card bg-success-gradient">
                <div class="card-header no-border">
                  <h3 class="card-title">
                    <fa icon="calendar" />
                    تقویم
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <fa icon="bars" />
                      </button>
                      <div class="dropdown-menu float-right" role="menu">
                        <a href="#" class="dropdown-item">رویداد تازه</a>
                        <a href="#" class="dropdown-item">حذف رویدادها</a>
                        <div class="dropdown-divider" />
                        <a href="#" class="dropdown-item">نمایش تقویم</a>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                      <fa icon="minus" />
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove">
                      <fa icon="times" />
                    </button>
                  </div>
                <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%" />
                </div>
              <!-- /.card-body -->
              </div>
            <!-- /.card -->
            </section>
          <!-- right col -->
          </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
  <!-- /.control-sidebar -->
  </div>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth',
  head () {
    return {
      title: this.$t('home')
    }
  },
  computed: {
    user () {
      return this.$auth.user
    }
  }
}
</script>
