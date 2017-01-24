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
    //Have the parent do its work, which will skip the front page.
    $breadcrumb = parent::build($route_match);

    //Now we need to check if the we are building for the front page
    $path = trim($this->context->getPathInfo());
    $front = $this->config->get('page.front');

    if ($path == '/' || $path == $front) {

      //Add the Home link to the home page
      $links = $breadcrumb->getLinks();
      $link = Link::createFromRoute($this->t('Home'), '<front>');
      array_unshift($links, $link);
      $breadcrumb->setLinks($links);
    }

    return $breadcrumb;
  }
}
