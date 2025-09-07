<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    @php
      $AllChatUserCount = App\Models\ChatModel::getAllChatUserCount()
    @endphp
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('chat') }}">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">{{ !empty($AllChatUserCount) ? $AllChatUserCount : '' }}</span>
      </a>
    </li>

  </ul>
</nav>
<!-- /.navbar -->


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center;">
      @if(!empty($getHeaderSetting->getLogo()))
       <img src="{{ $getHeaderSetting->getLogo() }}" style="width: auto;height: 60px;border-radius: 5px;">
      @else
        <span class="brand-text font-weight-light" style="font-weight: bold !important;font-size: 20px;">ALSID</span>
      @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img  style="height: 40px;width: 40px;" src="{{ Auth::user()->getProfileDirect() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
     <!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      @if(Auth::user()->user_type == 1)

       <li class="nav-item">
        <a href="{{ url('admin/dashboard') }}"  class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
          <i class="nav-icon fas fa-user-shield"></i>
          <p>
            Admin
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
          <i class="nav-icon fas fa-chalkboard-teacher"></i>
          <p>
            Guru
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
          <i class="nav-icon fas fa-user-graduate"></i>
          <p>
            Siswa
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
          <i class="nav-icon fas fa-user-friends"></i>
          <p>
            Orang Tua
          </p>
        </a>
      </li>

     <li class="nav-item  @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') active @endif">
          <i class="nav-icon fas fa-book-open"></i>
          <p>
            Akademis
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Kelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Mata Pelajaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Menetapkan Subjek</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Jadwal Kelas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Menugaskan Guru Kelas</p>
            </a>
          </li>
        </ul>
      </li>




      <li class="nav-item  @if(Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'examinations') active @endif">
          <i class="nav-icon fas fa-clipboard-list"></i>
          <p>
            Ujian
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/examinations/exam/list') }}" class="nav-link @if(Request::segment(3) == 'exam') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Ujian</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/examinations/exam_schedule') }}" class="nav-link @if(Request::segment(3) == 'exam_schedule') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Jadwal Ujian</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/examinations/marks_register') }}" class="nav-link @if(Request::segment(3) == 'marks_register') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Memberi Nilai </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/examinations/marks_grade') }}" class="nav-link @if(Request::segment(3) == 'marks_grade') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Menandai Nilai</p>
            </a>
          </li>
        </ul>
      </li>

     <li class="nav-item  @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'attendance') active @endif">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>
            Kehadiran
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Kehadiran Siswa</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ url('admin/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Kehadiran</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item  @if(Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'communicate') active @endif">
          <i class="nav-icon fas fa-comments"></i>
          <p>
            Komunikasi
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/communicate/notice_board') }}" class="nav-link @if(Request::segment(3) == 'notice_board') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Papan Pengumuman</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/communicate/send_email') }}" class="nav-link @if(Request::segment(3) == 'send_email') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Kirimkan Email</p>
            </a>
          </li>
        </ul>
      </li>

       <li class="nav-item  @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'homework') active @endif">
          <i class="nav-icon fas fa-book"></i>
          <p>
            PR
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>PR</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ url('admin/homework/homework_report') }}" class="nav-link @if(Request::segment(3) == 'homework_report') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan PR </p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
          <i class="nav-icon fas fa-user-cog"></i>
          <p>
            Akun Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
          <i class="nav-icon fas fa-cog"></i>
          <p>
            Setting
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
          <i class="nav-icon fas fa-key"></i>
          <p>
            Rubah Password
          </p>
        </a>
      </li>

      @elseif(Auth::user()->user_type == 2)

         <li class="nav-item">
          <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('teacher/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>
              Siswa Saya
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('teacher/my_class_subject') }}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Kelas Saya & Mata Pelajaran
            </p>
          </a>
        </li>

      <li class="nav-item">
        <a href="{{ url('teacher/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Jadwal Ujian Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('teacher/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
          <i class="nav-icon far fa-calendar"></i>
          <p>
            Kalender Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('teacher/marks_register') }}" class="nav-link @if(Request::segment(2) == 'marks_register') active @endif">
          <i class="nav-icon fas fa-clipboard-list"></i>
          <p>
            Memberi Nilai
          </p>
        </a>
      </li>

     <li class="nav-item  @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'attendance') active @endif">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>
            Kehadiran
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('teacher/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Kehadiran Siswa</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ url('teacher/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Kehadiran</p>
            </a>
          </li>
        </ul>
      </li>

       <li class="nav-item  @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
        <a href="#" class="nav-link  @if(Request::segment(2) == 'homework') active @endif">
          <i class="nav-icon fas fa-book"></i>
          <p>
            PR
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('teacher/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>PR</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ url('teacher/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
          <i class="nav-icon fas fa-bullhorn"></i>
          <p>
            Papan Pengumuan Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('teacher/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
          <i class="nav-icon fas fa-user-cog"></i>
          <p>
            Akun Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('teacher/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
          <i class="nav-icon fas fa-key"></i>
          <p>
            Rubah Password
          </p>
        </a>
      </li>

    @elseif(Auth::user()->user_type == 3)

      <li class="nav-item">
          <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>



      <li class="nav-item">
        <a href="{{ url('student/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
          <i class="nav-icon far fa-calendar"></i>
          <p>
            Kalender Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Mata Pelajaran Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Jadwal Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>
            Jadwal Ujian Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
          <i class="nav-icon fas fa-poll"></i>
          <p>
            Hasil Ujian Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('student/my_attendance') }}" class="nav-link @if(Request::segment(2) == 'my_attendance') active @endif">
          <i class="nav-icon fas fa-user-check"></i>
          <p>
            Kehadiran Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('student/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
          <i class="nav-icon fas fa-bullhorn"></i>
          <p>
            Papan Pengumuman Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/my_homework') }}" class="nav-link @if(Request::segment(2) == 'my_homework') active @endif">
          <i class="nav-icon fas fa-book-reader"></i>
          <p>
            PR Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/my_submitted_homework') }}" class="nav-link @if(Request::segment(2) == 'my_submitted_homework') active @endif">
          <i class="nav-icon fas fa-paper-plane"></i>
          <p>
            PR Terkirim Saya
          </p>
        </a>
      </li>

       <li class="nav-item">
        <a href="{{ url('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
          <i class="nav-icon fas fa-user-cog"></i>
          <p>
            Akun Saya
          </p>
        </a>
      </li>

        <li class="nav-item">
        <a href="{{ url('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
          <i class="nav-icon fas fa-key"></i>
          <p>
            Rubah Password
          </p>
        </a>
      </li>

      @elseif(Auth::user()->user_type == 4)

      <li class="nav-item">
          <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

     <li class="nav-item">
        <a href="{{ url('parent/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
          <i class="nav-icon fas fa-user-graduate"></i>
          <p>
            Siswa Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('parent/my_student_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_student_notice_board') active @endif">
          <i class="nav-icon fas fa-bullhorn"></i>
          <p>
            Papan Pengumuman Siswa Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('parent/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
          <i class="nav-icon fas fa-bullhorn"></i>
          <p>
            Papan Pengumuman Saya
          </p>
        </a>
      </li>

     <li class="nav-item">
        <a href="{{ url('parent/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
          <i class="nav-icon fas fa-user-cog"></i>
          <p>
            Akun Saya
          </p>
        </a>
      </li>

        <li class="nav-item">
        <a href="{{ url('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
          <i class="nav-icon fas fa-key"></i>
          <p>
            Rubah Password
          </p>
        </a>
      </li>

      @endif

      <li class="nav-item">
        <a href="{{ url('logout') }}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>
            Logout
          </p>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
