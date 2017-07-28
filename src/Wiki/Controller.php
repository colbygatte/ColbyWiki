<?php

namespace Wiki;

use Wiki\Interfaces\AbstractController;

class Controller extends AbstractController
{
    function actionHome()
    {
        return view('home', [
            'name' => parse('MainPage')->getParsedText()
        ]);
    }
    
    function actionViewPage()
    {
        $page = $this->requestedPage();
        
        if (! $page) {
            die("You didn't tell me what page to look for (RUDE)");
        }
        
        if (! $page->exists()) {
            return redirect('?action=edit_page&page='.$page->getPageName());
        }
        
        $wikiText = parse($page);
        
        return view('view', compact('wikiText'));
    }
    
    public function actionEditPage()
    {
        return view('edit', [
            'text' => $this->requestedPage()->getText()
        ]);
    }
    
    /**
     * @return \Wiki\Wiki\WikiPage
     */
    protected function requestedPage()
    {
        return page(request('page'));
    }
}
