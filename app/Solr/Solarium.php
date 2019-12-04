<?php
namespace App\Solr;

use Illuminate\Http\Request;

class Solarium
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    public function ping()
    {
        // create a ping query
        $ping = $this->client->createPing();
        // execute the ping query
        try {
            $this->client->ping($ping);
            return response()->json('OK');
        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }
    public function search($search = array(), $page = 1, $perPage = 10, $sort = array(), $select = array())
    {
        $query = $this->client->createSelect();
        try{
            $temp = '';
            foreach ($search as $key => $item) {
                if($item) {
                    $temp = $temp . ($key . ':' . $item) . ' | ';
                }
//                $query->addFilterQuery(array('key' => $key, 'query' => $key . ':*' . $item . '*'));
//                $query->addFilterQuery(array('key' => $key, 'query' => $key . ':' . $item ));
            }
            $query->setQuery(substr($temp, 0, strlen($temp) - 3));
            $query->createFilterQuery('*,score');
            $rows = $perPage;

            $query->setStart(($page == 1 ? 0 : $page - 1) * $rows)->setRows($rows); // perpage, rows
            if($sort) {
                foreach ($sort as $key => $val) {
                    $query->addSort($key, $val);
                }
            }
            $data = [];
            // display the total number of documents found by solr
//          $facetSet = $query->getFacetSet();
//          $facetSet->createFacetField('stock')->setField('inStock');
            $resultset = $this->client->select($query);
//            dd($resultset);
            // show documents using the resultset iterator
            foreach ($resultset as $document) {
                $data[] = $document;
            }
            return [
                'status' => true,
                'message' => '',
                'data' => $data,
                'rows' => $rows,
                'page' => $page,
                'row_total' => $resultset->getNumFound(),
            ];
        }
        catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    public function searchCurl($search = array(), $page = 1, $perPage = 10, $sort = '', $select = array()) {
        $ch = curl_init();
        $url = env("SOLR_HOST").':'.env("SOLR_PORT").env("SOLR_PATH").env("SOLR_CORE").'/select?q=';
        foreach ($search as $key => $item) {
            $url = $url . $key . ':' . urlencode($item) . '*%20|%20';
            $url = $url . $key . ':*' . urlencode($item) . '*%20|%20';
        }
        if($sort) {
            $url = $url . $sort;
        }
        $url = $url.'&rows='.$perPage.'&start='.(($page == 1 ? 0 : $page - 1) * $perPage);
//        var_dump($url);exit;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result=curl_exec($ch);
        curl_close($ch);

//        $result = file_get_contents($url);
        $result = json_decode($result, true);
        return [
            'status' => true,
            'message' => '',
            'data' => $result['response']['docs'],
            'rows' => $perPage,
            'page' => $page,
            'row_total' => $result['response']['numFound'],
        ];
    }
    public function solrDeleteById($id = ''){
        $update = $this->client->createUpdate();
        try{
            $update->addDeleteById($id);
            $update->addCommit();
            $result = $this->client->update($update);
            return [
                'status' => true,
                'message' => ''
            ];
        }
        catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function solrMultiDeleteById($ids = ''){
        $update = $this->client->createUpdate();
        for ($i = 0; $i < sizeof($ids); $i++) {
            $id = $ids[$i];
            try {
                $update->addDeleteById($id);
            } catch (Exception $e) {
                return [
                    'status' => false,
                    'message' => $e->getMessage()
                ];
            }
        }
        $update->addCommit();
        $result = $this->client->update($update);
        return [
            'status' => true,
            'message' => ''
        ];
    }
    public function solrDeleteByQuery($queries){
        $update = $this->client->createUpdate();
        try{
            $update->addDeleteQuery($queries);
            $update->addCommit();
            $result = $this->client->update($update);
            return [
                'status' => true,
                'message' => ''
            ];
        }
        catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    public function addDocuments(array $data = array(), $overWrite = true) {
        $update = $this->client->createUpdate();

        $doc = $update->createDocument();
        foreach($data as $key => $val) {
            $doc->$key = $val;
        }
//        $doc->id = 123;
//        $doc->name = 123;
//        $doc->price = 364;
//        $doc->des = array('doc test 2', 'doc test 4', 'doc test 5');
        try{
            $update->addDocument($doc, $overWrite);
            $update->addCommit();
            $result = $this->client->update($update);
            return [
                'status' => true,
                'message' => ''
            ];
        }
        catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
//            'time' => $result->getQueryTime(),
            ];
        }

    }

    public function addMultiDocuments(array $datas = array(), $overWrite = true)
    {
        $update = $this->client->createUpdate();

        for ($i = 0; $i < sizeof($datas); $i++) {
            $data = $datas[$i];
            $doc = $update->createDocument();
            foreach ($data as $key => $val) {
                $doc->$key = $val;
            }

            try {
                $update->addDocument($doc, $overWrite);
            } catch (Exception $e) {
                return [
                    'status' => false,
                    'message' => $e->getMessage()
//            'time' => $result->getQueryTime(),
                ];
            }
        }

        $update->addCommit();
        $result = $this->client->update($update);
        return [
            'status' => true,
            'message' => ''
        ];
    }

}

?>