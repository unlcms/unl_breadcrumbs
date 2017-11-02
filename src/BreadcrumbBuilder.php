<?php

namespace Drupal\unl_breadcrumbs;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\system\PathBasedBreadcrumbBuilder;

/**
 * Class to define the menu_link breadcrumb builder.
 */
class BreadcrumbBuilder extends PathBasedBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    /**
     * @var $breadcrumb Breadcrumb
     */
    // Have the parent do its work, which skip the <front> page.
    $breadcrumb = parent::build($route_match);

    // Add the Home link to the <front> page.
    if (\Drupal::service('path.matcher')->isFrontPage()) {
      $links = $breadcrumb->getLinks();
      $link = Link::createFromRoute($this->t('Home'), '<front>');
      array_unshift($links, $link);
      $breadcrumb->setLinks($links);
    }

    return $breadcrumb;
  }

  public function __construct(\Drupal\Core\Routing\RequestContext $context, \Drupal\Core\Access\AccessManagerInterface $access_manager, \Symfony\Component\Routing\Matcher\RequestMatcherInterface $router, \Drupal\Core\PathProcessor\InboundPathProcessorInterface $path_processor, \Drupal\Core\Config\ConfigFactoryInterface $config_factory, \Drupal\Core\Controller\TitleResolverInterface $title_resolver, \Drupal\Core\Session\AccountInterface $current_user, \Drupal\Core\Path\CurrentPathStack $current_path, \Drupal\Core\Path\PathMatcherInterface $path_matcher = NULL) {
    parent::__construct($context, $access_manager, $router, $path_processor, $config_factory, $title_resolver, $current_user, $current_path, $path_matcher);
  }
}
