<?php

/**
 * 异常报警
 *
 * 如果调用到相关权限时，未找到注册信息，则发送邮件，或短信，并在管理页面进行提示显示
 */

return [

'SYSTEM_CONFIG_MAIL',
'SYSTEM_CONFIG_USER_GUEST',


'F_USER_POST',
'F_USER_DELETE',
'F_USER_PUT',
'F_USER_DELETE',

'T_POST_POST',
'T_POST_DELETE',
'T_POST_PUT',
'T_POST_GET',


'T_FILE_POST',
'T_FILE_PUT',
'T_FILE_DELETE',
'T_FILE_GET',



'LOG_PERMISSION',
'LOG_USER',

];
