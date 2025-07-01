<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="{{ Request::path() == 'dashboard' ? 'active' : '' }}"> <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
				<li class="list-divider"></li>

				<li class="{{ Request::path() == 'booking' ? 'active' : '' }}"> <a href="{{ route('booking.index') }}"><i class="fas fa-suitcase"></i> <span>Booking</span></a> </li>
				{{-- <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
					<ul class="submenu_class" style="display: none;">
						<li><a href="all-booking.html"> All Booking </a></li>
						<li><a href="edit-booking.html"> Edit Booking </a></li>
						<li><a href="add-booking.html"> Add Booking </a></li>
					</ul>
				</li> --}}
			</ul>
		</div>
	</div>
</div>