
var log = console.log.bind(console);

$(document).ready(init);

function init() {
	log('document ready!');

	var pageMode = $('.jsdata').data('pageMode');
	switch (pageMode) {
		case 'login-page':
			LoginPage.init();
			break;
		case 'chat-page':
			AppBar.init();
			//initChatPage();
			break;
		default:
			break;
	}
}

LoginPage = {};
AppBar = {};

LoginPage.init = function() {
	log('initting login.');
	$('.login-userlist-user').click(LoginPage.userItemClicked);
	$('.login-forms-goback').click(LoginPage.gobackClicked)
}

LoginPage.userItemClicked = function(domEvent) {
	LoginPage.hideUI();
	var username = $(domEvent.currentTarget).data('username');
	$('.login-forms').show();
	$('.login-forms-form[data-username="' + username + '"]').show();
	$('.login-forms-form[data-username="' + username + '"] input[name="password"]').focus();
}

LoginPage.gobackClicked = function(domEvent) {
	LoginPage.hideUI();
	$('.login-userlist').show();
}

LoginPage.hideUI = function() {
	$('.login-userlist').hide();
	$('.login-forms').hide();
	$('.login-forms-form').hide();
}


AppBar.init = function() {
	$('.appbar-right-accountmenu-menu-item').click(AppBar.accountMenuItemClicked);
}

AppBar.accountMenuItemClicked = function(domEvent) {
	log('clicked!');
	switch ($(domEvent.currentTarget).data('menuAction')) {
		case 'logout':
			AppBar.logout();
			break;
	}
}

AppBar.logout = function() {
	window.location.href = '/logout.php'
}
