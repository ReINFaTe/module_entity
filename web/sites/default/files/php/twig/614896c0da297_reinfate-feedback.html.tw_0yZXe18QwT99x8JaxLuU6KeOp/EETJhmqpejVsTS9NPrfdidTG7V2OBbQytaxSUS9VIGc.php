<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/reinfate/templates/reinfate-feedback.html.twig */
class __TwigTemplate_82e4c032fb3b7363dc961102e6ee494b26a51c805f8df6d37ff0808ea5e90fe6 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 1, $this->source), "html", null, true);
        echo ">
  ";
        // line 2
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 2, $this->source), "html", null, true);
        echo "
  <div class=\"feedback-authored\">
    ";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "avatar", [], "any", false, false, true, 4), 4, $this->source), "html", null, true);
        echo "
    ";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "name", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
        echo "
    ";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "created", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
        echo "
  </div>
  <div class=\"feedback-content\">
    ";
        // line 9
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "feedback", [], "any", false, false, true, 9), 9, $this->source), "html", null, true);
        echo "
    ";
        // line 10
        if ( !twig_test_empty((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "image", [], "any", false, false, true, 10)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[0] ?? null) : null))) {
            // line 11
            echo "      <div class=\"feedback-attachments\">
        ";
            // line 12
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "image", [], "any", false, false, true, 12), 12, $this->source), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 15
        echo "  </div>
  <div class=\"feedback-contacts\">
    ";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "email", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
        echo "
    ";
        // line 18
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "telephone", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
        echo "
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/reinfate/templates/reinfate-feedback.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 18,  82 => 17,  78 => 15,  72 => 12,  69 => 11,  67 => 10,  63 => 9,  57 => 6,  53 => 5,  49 => 4,  44 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div{{ attributes }}>
  {{ title_suffix }}
  <div class=\"feedback-authored\">
    {{ content.avatar }}
    {{ content.name }}
    {{ content.created }}
  </div>
  <div class=\"feedback-content\">
    {{ content.feedback }}
    {% if content.image[0] is not empty %}
      <div class=\"feedback-attachments\">
        {{ content.image }}
      </div>
    {% endif%}
  </div>
  <div class=\"feedback-contacts\">
    {{ content.email }}
    {{ content.telephone }}
  </div>
</div>
", "modules/custom/reinfate/templates/reinfate-feedback.html.twig", "/var/www/web/modules/custom/reinfate/templates/reinfate-feedback.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 10);
        static $filters = array("escape" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
