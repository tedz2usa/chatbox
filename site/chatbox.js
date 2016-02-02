
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
			initChatPage();
			break;
		default:
			break;
	}
}

LoginPage = {};

LoginPage.init = function() {
	log('initting login.');
	$('.login-userlist-user').click(LoginPage.userItemClicked);
	$('.login-forms-goback').click(LoginPage.gobackClicked)
}

LoginPage.userItemClicked = function(domevent) {
	LoginPage.hideUI();
	var username = $(domevent.currentTarget).data('username');
	$('.login-forms').show();
	$('.login-forms-form[data-username="' + username + '"]').show();
}

LoginPage.gobackClicked = function(domevent) {
	LoginPage.hideUI();
	$('.login-userlist').show();
}

LoginPage.hideUI = function() {
	$('.login-userlist').hide();
	$('.login-forms').hide();
	$('.login-forms-form').hide();
}
