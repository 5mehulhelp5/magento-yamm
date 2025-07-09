<?php
/**
 * CategoryRepository
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model;


use Magento\Catalog\Model\CategoryFactory as CategoriesFactory;
use Magento\Framework\Data\Tree\Node;
use Mageserv\Yamm\Api\CategoryRepositoryInterface;
use Mageserv\Yamm\Api\Data\CategoryInterfaceFactory;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $categoryFactory;
    protected $categoriesFactory;
    protected $categoryRepository;
    protected $categoryTree;

    public function __construct(
        CategoryInterfaceFactory                         $categoryFactory,
        CategoriesFactory                                $categoriesFactory,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Catalog\Model\Category\Tree             $categoryTree
    )
    {
        $this->categoryFactory = $categoryFactory;
        $this->categoriesFactory = $categoriesFactory;
        $this->categoryRepository = $categoryRepository;
        $this->categoryTree = $categoryTree;
    }

    public function getCategoriesTree($rootCategoryId = null, $depth = null)
    {
        $category = null;
        if ($rootCategoryId !== null) {
            /** @var \Magento\Catalog\Model\Category $category */
            $category = $this->categoryRepository->get($rootCategoryId);
        } else {
            $categoriesCollection = $this->categoriesFactory->create()->getCollection();
            $category = $categoriesCollection->addFilter('level', ['eq' => 0])->getFirstItem();
        }
        return $this->getTree($this->categoryTree->getRootNode($category), $depth);
    }

    public function getTree($node, $depth = null, $currentLevel = 0)
    {
        /** @var CategoryInterface[] $children */
        $children = $this->getChildren($node, $depth, $currentLevel);
        /** @var CategoryInterface $tree */
        $tree = $this->categoryFactory->create();
        $tree->setCategoryId($node->getId())
            ->setParentId($node->getParentId())
            ->setName($node->getName())
            ->setSortOrder($node->getPosition())
            ->setStatus($node->getIsActive())
            ->setChildren($children);
        if($node->getLevel() == 0)
            $tree->setStatus(1);
        return $tree;
    }

    /**
     * Get node children.
     *
     * @param Node $node
     * @param int $depth
     * @param int $currentLevel
     * @return CategoryInterface[]|[]
     */
    protected function getChildren($node, $depth, $currentLevel)
    {
        if ($node->hasChildren()) {
            $children = [];
            foreach ($node->getChildren() as $child) {
                if ($depth !== null && $depth <= $currentLevel) {
                    break;
                }
                $children[] = $this->getTree($child, $depth, $currentLevel + 1);
            }
            return $children;
        }
        return [];
    }
}
