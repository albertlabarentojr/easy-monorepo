<?php
declare(strict_types=1);

namespace StepTheFkUp\Pagination\Bridge\Laravel;

use Closure;
use Illuminate\Support\ServiceProvider;
use StepTheFkUp\Pagination\Interfaces\PagePaginationDataInterface;
use StepTheFkUp\Pagination\Interfaces\PaginationConstants;
use StepTheFkUp\Pagination\PagePaginationData;

class PageBasedPaginationProvider extends ServiceProvider
{
    /**
     * Register pagination data into services container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PagePaginationDataInterface::class, $this->getPageBasedPaginationDataClosure());
    }

    /**
     * Get closure to instantiate the page based pagination data.
     *
     * @return \Closure
     */
    private function getPageBasedPaginationDataClosure(): Closure
    {
        return function (): PagePaginationDataInterface {
            $config = $this->app->get('config')->get('pagination');
            /** @var \Illuminate\Http\Request $request */
            $request = $this->app->get('request');

            $attrPage = $config['attr_page'] ?? PaginationConstants::ATTRS_PAGE;
            $attrPerPage = $config['attr_per_page'] ?? PaginationConstants::ATTRS_PER_PAGE;
            $defaultPage = $config['default_page'] ?? PaginationConstants::DEFAULT_PAGE;
            $defaultPerPage = $config['default_per_page'] ?? PaginationConstants::DEFAULT_PER_PAGE;

            return new PagePaginationData(
                $request->get($attrPage, $defaultPage),
                $request->get($attrPerPage, $defaultPerPage)
            );
        };
    }
}