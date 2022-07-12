<?php

class Pager
{

    public $links = array();
    public $offset = 0;
    public $page_number = 1;
    public $start = 1;
    public $end = 1;

    public function __construct($limit = 10, $extras = 1)
    {
        $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;

        $this->start = $page_number - $extras;
        if ($this->start < 1) {
            $this->start = 1;
        }

        $this->end = $page_number + $extras;


        $this->offset = ($page_number - 1) * $limit;
        $this->page_number = $page_number;

        $currentLink =  ROOT . "/" . str_replace("url=", "", $_SERVER['QUERY_STRING']);
        $currentLink = !strstr($currentLink, "page=") ? $currentLink . "&page=1" : $currentLink;
        // regular expresion replace
        $nextLink = preg_replace('/page=[0-9]+/', "page=" . ($page_number + $extras + 1), $currentLink);
        $firstLink = preg_replace('/page=[0-9]+/', "page=1", $currentLink);

        $this->links['first'] = $firstLink;
        $this->links['current'] = $currentLink;
        $this->links['next'] = $nextLink;
    }

    public function display()
    {
?>
        <!-- Used a closing tag so as to allow the html run -->
        <br class="clearfix">
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="<?= $this->links['first'] ?>">First</a></li>

                    <?php for ($i = $this->start; $i <= $this->end; $i++) : ?>
                        <li class="page-item 
                        <?= ($i == $this->page_number) ? 'active ' : ''; ?>
                        "><a class="page-link" href="
                        <?= preg_replace('/page=[0-9]+/', "page=" . $i,  $this->links['current']) ?>">
                                <?= $i ?></a></li>
                    <?php endfor; ?>

                    <li class="page-item"><a class="page-link" href="<?= $this->links['next'] ?>">Next</a></li>
                </ul>
            </nav>
        </div>
<?php
    }
}
