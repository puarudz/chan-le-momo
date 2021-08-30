 <!--============= Header Section Starts Here =============-->
 <header class="header-section" style="background-color: #3b319e;top:0px;">
     <div class="container">
         <div class="header-wrapper">
             <div class="logo">
                 <a href="<?=BASE_URL('');?>">
                     <img src="<?=getSite('logo');?>" alt="<?=getSite('title');?>">
                 </a>
             </div>
             <ul class="menu">
                 <?php if(getSite('show_top') == 'ON') { ?>
                 <li>
                     <a href="<?=BASE_URL('top');?>">BẢNG XẾP HẠNG</a>
                 </li>
                 <?php }?>
             </ul>
             <div class="header-bar d-lg-none">
                 <span></span>
                 <span></span>
                 <span></span>
             </div>
             <div class="header-right">
                 <a href="<?=BASE_URL('login');?>" class="header-button d-none d-sm-inline-block">ĐĂNG NHẬP</a>
             </div>
         </div>
     </div>
 </header>
 <!--============= Header Section Ends Here =============-->