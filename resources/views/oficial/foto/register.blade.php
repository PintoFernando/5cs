@extends('layouts.app')
@section('body-class','signup-page')
@section('content')
<div class="header header-filter" style="background-image: url('{{asset('/img/city.jpg')}}'); background-size: cover; background-position: top center;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">
                    <form class="form" method="POST" action="{{url('oficial/foto/createregister')}}">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h4>Registro</h4>
                           <!--  <div class="social-line">
                               <a href="#pablo" class="btn btn-simple btn-just-icon">
                                   <i class="fa fa-facebook-square"></i>
                               </a>
                               <a href="#pablo" class="btn btn-simple btn-just-icon">
                                   <i class="fa fa-twitter"></i>
                               </a>
                               <a href="#pablo" class="btn btn-simple btn-just-icon">
                                   <i class="fa fa-google-plus"></i>
                               </a>
                           </div> -->
                        </div>
                        <p class="text-divider"> Completa  tus datos</p>
                        <div class="content">

                        
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nombre..." name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <input id="email" type="email" class="form-control" placeholder="Correo electronico..." name="email" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <input placeholder="Contrase??a..."id="password" type="password" class="form-control" name="password" required />
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <input placeholder="repetir contrase??a..."id="password" type="password" class="form-control" name="password_confirmation" required />
                            </div>

                            <div class="input-group">
                                
                                <input id="id_rol" type="hidden" class="form-control" name="id_rol" value="5" hidden/>
                            </div>

                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-simple btn-primary btn-lg"> Confirmar registro </button> 
                        </div>

                       <!--  <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <nav class="pull-left">
               <!--  <ul>
                   <li>
                       <a href="http://www.creative-tim.com">
                           Creative Tim
                       </a>
                   </li>
                   <li>
                       <a href="http://presentation.creative-tim.com">
                          About Us
                       </a>
                   </li>
                   <li>
                       <a href="http://blog.creative-tim.com">
                          Blog
                       </a>
                   </li>
                   <li>
                       <a href="http://www.creative-tim.com/license">
                           Licenses
                       </a>
                   </li>
               </ul> -->
            </nav>
            <div class="copyright pull-right">
                &copy; 2017, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com" target="_blank">Team Sistemas</a>
            </div>
        </div>
    </footer>

</div>
@endsection