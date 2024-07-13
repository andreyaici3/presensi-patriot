<x-app-layout-v2 menuActive="home" title="Dashboard">
   <div class="min-height-200px">
       <div class="page-header">
           <div class="row">
               <div class="col-md-6 col-sm-12">
                   <div class="title">
                       <h4>Halaman Depan</h4>
                   </div>
                   <nav aria-label="breadcrumb" role="navigation">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                           </li>
                       </ol>
                   </nav>
               </div>
           </div>
       </div>

       @if(Auth::user()->role == 'superuser' || Auth::user()->role == 'kurikulum')
            @include('present-track-v2.dashboard.kurikulum')
       @endif

   </div>
</x-app-layout-v2>
