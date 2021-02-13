<?php

trait mse2FiltersHelperMs2Collection
{
    /**
     * @param array $fields
     * @param array $ids
     * @return array
     */
    public function getMs2CollectionValues(array $fields, array $ids)
    {
        $filters = [];

        $query = $this->modx->newQuery('msProductData');
        $query->where([
            'msProductData.id:IN' => $ids,
            'OR:msProductData.ms2collection_parent_id:IN' => $ids,
        ]);
        $query->select('id,ms2collection_parent_id,' . implode(',', $fields));

        $tstart = microtime(true);
        if (!$query->prepare() || !$query->stmt->execute()) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r([
                '[mSearch2] Error on get filter params',
                'Query: ' . $query->toSQL(),
                'Response: ' . $query->stmt->errorInfo(),
            ], true));
            return $filters;
        }
        $this->modx->queryTime += microtime(true) - $tstart;
        $this->modx->executedQueries++;

        while ($row = $query->stmt->fetch(PDO::FETCH_ASSOC)) {
            $resourceId = $row['id'];
            if ($row['ms2collection_parent_id'] != 0) {
                $resourceId = $row['ms2collection_parent_id'];
            }
            foreach ($row as $k => $v) {
                $v = str_replace('"', '&quot;', trim($v));
                if ($k == 'id' || $k == 'ms2collection_parent_id') {
                    continue;
                }
                if (!isset($filters[$k][$v])) {
                    $filters[$k][$v] = [];
                }
                $filters[$k][$v][$resourceId] = $resourceId;
            }
        }
        return $filters;
    }
}
