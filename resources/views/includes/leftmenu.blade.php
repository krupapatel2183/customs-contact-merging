<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="{{ request()->routeIs('contacts.*') ? 'active' : '' }}">
					<a href="{{ route('contacts.index') }}">
						<i class="fas fa-tachometer-alt"></i> <span>Contacts</span>
					</a>
				</li>
				<li class="list-divider"></li>
			</ul>
		</div>
	</div>
</div>