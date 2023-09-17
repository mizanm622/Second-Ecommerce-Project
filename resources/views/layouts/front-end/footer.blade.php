<div class="footer">

          <!-- Footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="{{route('home')}}" class="text-primary">{{$settings->name}}</a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">{{$settings->phone_one}}</div>
						<div class="footer_contact_text">
                            <address>
                                <p>{{$settings->address}}</p>
                                <p>{{$settings->town}},{{$settings->city}}-{{$settings->zip}}</p>
                                <p>{{$settings->country}}</p>
                            </address>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="{{$settings->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="{{$settings->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li><a href="{{$settings->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
								<li><a href="{{$settings->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<li><a href="{{$settings->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Find it Fast</div>
						<ul class="footer_list">
                            @foreach ($populerCategory as $subcategory)
                            <li><img class="img-thumbnail rounded-circle" src="{{asset($subcategory->subcategory_logo)}}" alt="{{$subcategory->subcategory_name}}" width="30" height="30"> <a href="{{route('category.product',$subcategory->id)}}">{{$subcategory->subcategory_name}}</a></li>
                            @endforeach
						</ul>

					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
                        <div class="footer_title">Pages</div>
						<ul class="footer_list footer_list_2">

                            @foreach ($footerPages as $footerPage)

							<li><a href="{{route('page',$footerPage->id)}}">{{$footerPage->page_title}}</a></li>
                            @endforeach

						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="{{route('user.profile')}}">My Account</a></li>
							<li><a href="{{route('user.profile')}}">Order Tracking</a></li>
							<li><a href="{{route('user.profile')}}">Wish List</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->


<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content">
                        Copyright &copy;<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://templatespoint.net/" target="_blank">TemplatesPoint</a>
                        </div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
