<?php
/**
 * @author Todd Burry <todd@vanillaforums.com>
 */

/**
 * Some proof of concept security tests.
 */
class SecurityPOCTest extends PHPUnit_Smarty {
    public $loadSmartyBC = true;

    /**
     * @inheritDoc
     */
    public function setUp() {
        $this->setUpSmarty(dirname(__FILE__));

        $this->smarty->setForceCompile(true);
        $this->smarty->enableSecurity();
        $this->smartyBC->setForceCompile(true);
        $this->smartyBC->enableSecurity();
    }

    /**
     * No static access is allowed when static classes is null.
     */
    public function testStaticVariableCall() {
        $this->smarty->security_policy->static_classes = null;

        $this->expectExceptionMessage("access to static class members through variables is not allowed by security setting");
        $r = $this->smarty->fetch('static-variable-call.tpl');
    }

    /**
     * Stream variables can be disabled via security policy.
     */
    public function testStreamInput() {
        $this->smarty->security_policy->allow_stream_variables = false;

        $this->expectExceptionMessage('access to stream variables is not allowed by security setting');
        $r = $this->smarty->fetch('string:{$php:input}');
    }

    public function testDisableSecurity() {
        $this->smarty->security_policy->static_classes = null;
        $this->smarty->security_policy->disabled_special_smarty_vars[] = 'template_object';
        $r = $this->smarty->fetch('disable-security.tpl');
    }
}
