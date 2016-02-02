
var log = console.log.bind(console);

$(document).ready(init);

function init() {
	log('document ready!');

	var pageMode = $('.jsdata').data('pageMode');
	switch (pageMode) {
		case 'login-page':
			initLoginPage();
			break;
		case 'chat-page':
			initChatPage();
			break;
		default:
			break;
	}
}


function initLoginPage() {
	log('initting login.');
	$('.login-userlist-user').click(loginUserItemClicked);
}

function loginUserItemClicked(domevent) {
	log(domevent);
	loginHideUI();
	var username = $(domevent.currentTarget).data('username');
	$('.login-forms').show();
	$('.login-forms-form[data-username="' + username + '"]').show();
}

function loginHideUI() {
	$('.login-forms').hide();
	$('.login-forms-form').hide();
	$('.login-userlist').hide();
}
