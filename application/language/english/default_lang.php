<?php

delete_cookie('page_language');
set_cookie('page_language','en','86400');
/*-------------------------ENGLISH------------------------------*/
$lang['enter']  = 'Enter';
$lang['login']  = 'Login';
$lang['logout'] = 'Logout';
$lang['users']  = 'Users';
$lang['results'] = 'Results';
$lang['cancel'] = 'Cancel';

$lang['greetings'] = 'Greetings';
$lang['page_h1_users'] = 'Users page';
$lang['page_h1_results'] = 'Results page';

/*-------------------------USERS PAGE------------------------------*/

$lang['label_name'] = 'Name';
$lang['label_email'] = 'E-mail address';
$lang['label_pass'] = 'Password';
$lang['label_pass_again'] = 'Password again';
$lang['label_permission'] = 'Permission';
$lang['label_permission_select'] = 'Choose permission';

$lang['registration'] = 'Registration';
$lang['delete_user'] = 'Delete user';
$lang['add_button'] = 'Recording';

$lang['permission_admin'] = 'Admin';
$lang['permission_user'] = 'User';
$lang['permission_reader'] = 'Reader';

$lang['empty_user_row'] = 'User didn`t record';
$lang['question_delete_user'] = 'Do you really want to delete this user?';

/*-------------------------RESULTS PAGE------------------------------*/
$lang['modify_button'] = 'Modification';

$lang['label_date'] = 'Date';
$lang['label_home_team'] = 'Home team';
$lang['label_away_team'] = 'Away team';
$lang['label_result'] = 'Result';
$lang['label_home_score'] = 'Home scores';
$lang['label_away_score'] = 'Away scores';
$lang['label_tournament'] = 'Tournament';
$lang['label_city'] = 'City';
$lang['label_country'] = 'Country';
$lang['label_new_result'] = 'New result';

$lang['title_modify_result'] = 'Result modification';
$lang['title_delete_result'] = 'Delete result';

$lang['empty_result_row'] = 'Result didn`t record';
$lang['question_delete_result'] = 'Do you really want to delete this result?';
$lang['user_info_text'] = 'Just the admin user can registrate and delete user profiles.<br>You can not delete your profile.';

/*-------------------------filter------------------------------*/
$lang['filter_team'] = 'Search (team name)';
$lang['empty_filter_row'] = 'Searching didn`t have result.';
/*-------------------------pagination------------------------------*/
$lang['pag_first'] = 'First';
$lang['pag_previous'] = 'Previous';
$lang['pag_next'] = 'Next';
$lang['pag_last'] = 'Last';


/*-------------------------errors------------------------------*/
$lang['error_empty_field']    = 'You must fill all fields';
$lang['error_invalid_email']  = 'Invalid e-mail address.';
$lang['error_incorrect_email'] = 'Incorrect e-mail address.';
$lang['error_incorrect_email_and_pass'] = 'Incorrect e-mail address and/or password using.';
$lang['error_invalid_passwords'] = 'The two passwords must be the same.';
$lang['error_reserved_email'] = 'This e-mail address is already in use.';
$lang['error_registration'] = 'Error while the registration.';
$lang['error_data_values'] = 'Error in entering data.';
$lang['error_delete'] = 'Error while the deletion.';
$lang['error_delete_yourself'] = 'You can`t delete your profile.';
$lang['error_insert'] = 'Error while recording';
$lang['error_date'] = 'The date must be less than today.';
$lang['error_query'] = 'Error while the inquiry of datas.';
$lang['error_update'] = 'Error while the modifiation.';
/*-------------------------success------------------------------*/
$lang['success_login'] = 'Success login';
$lang['success_logout'] = 'Success logout';
$lang['success_user_registration'] = 'User registration was succesful';
$lang['success_user_delete'] = 'User deletion was succesful';
$lang['success_result_insert'] = 'Result recording was succesful';
$lang['success_result_update'] = 'Result update was succesful';
$lang['success_result_delete'] = 'Result deletion was succesful';
