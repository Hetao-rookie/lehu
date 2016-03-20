<?php

/**
 * 异常报警.
 *
 * 如果调用到相关权限时，未找到注册信息，则发送邮件，或短信，并在管理页面进行提示显示
 */

return [
'USER_POST',
'USER_DELETE',
'USER_PUT',
'USER_DELETE',
'T:POST_POST',
'T:POST_DELETE',
'T:POST_PUT',
'T:POST_GET',
'T:FILE_POST',
'T:FILE_PUT',
'T:FILE_DELETE',
'T:FILE_GET',
'T:LOG_GET',
'T:LOG_DELETE',
'SYSTEM_CONFIG_MAIL',
'SYSTEM_CONFIG_USER_GUEST',
];
