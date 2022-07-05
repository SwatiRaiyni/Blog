@extends('layouts.backend_user.layout')
@section('content')
<div class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}

            </h2>
            You're logged In as Role {{$roles[0]}}!
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">




    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{App\Models\User::count();}}</h3>

                  <p>No. of users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="/{{app()->getLocale()}}/usermangementajaxviewserverside" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{App\Models\UserPost::count();}}</h3>

                  <p>No. of blogs</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="/{{app()->getLocale()}}/user_blog" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{App\Models\User::where('IsApproved','1')->count();}}</h3>

                  <p>No. of Active user</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/{{app()->getLocale()}}/usermangementajaxviewserverside" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{App\Models\UserPost::where('Isactive_'.app()->getLocale(),'1')->count();}}</h3>

                    <p>No. of Active Blogs</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/{{app()->getLocale()}}/user_blog" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div id="piechart" style="width: 900px; height: 500px;"></div>
          </div>
        </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['No. of Active User',    {{App\Models\User::where('IsApproved','1')->count()}}],
          ['No. of InActive User',   {{App\Models\User::where('IsApproved','0')->count()}}],
          ['No. of Active Blog',  {{App\Models\UserPost::where('Isactive_'.app()->getLocale(),'1')->count()}}],
          ['No. of Inactive Blog', {{App\Models\UserPost::where('Isactive_'.app()->getLocale(),'0')->count()}}]
        ]);

        var options = {
          title: 'Information'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>





                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
