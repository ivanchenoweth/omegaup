<?php

/** ******************************************************************************* *
  *                    !ATENCION!                                                   *
  *                                                                                 *
  * Este codigo es generado automaticamente. Si lo modificas tus cambios seran      *
  * reemplazados la proxima vez que se autogenere el codigo.                        *
  *                                                                                 *
  * ******************************************************************************* */

/** ProblemsLanguages Data Access Object (DAO) Base.
 *
 * Esta clase contiene toda la manipulacion de bases de datos que se necesita
 * para almacenar de forma permanente y recuperar instancias de objetos
 * {@link ProblemsLanguages}.
 * @access public
 * @abstract
 *
 */
abstract class ProblemsLanguagesDAOBase {
    /**
     * Obtener {@link ProblemsLanguages} por llave primaria.
     *
     * Este metodo cargará un objeto {@link ProblemsLanguages} de la base
     * de datos usando sus llaves primarias.
     *
     * @return ?ProblemsLanguages Un objeto del tipo {@link ProblemsLanguages}. NULL si no hay tal registro.
     */
    final public static function getByPK(?int $problem_id, ?int $language_id) : ?ProblemsLanguages {
        $sql = 'SELECT `Problems_Languages`.`problem_id`, `Problems_Languages`.`language_id` FROM Problems_Languages WHERE (problem_id = ? AND language_id = ?) LIMIT 1;';
        $params = [$problem_id, $language_id];
        global $conn;
        $row = $conn->GetRow($sql, $params);
        if (empty($row)) {
            return null;
        }
        return new ProblemsLanguages($row);
    }

    /**
     * Eliminar registros.
     *
     * Este metodo eliminará el registro identificado por la llave primaria en
     * el objeto ProblemsLanguages suministrado. Una vez que se ha
     * eliminado un objeto, este no puede ser restaurado llamando a
     * {@link replace()}, ya que este último creará un nuevo registro con una
     * llave primaria distinta a la que estaba en el objeto eliminado.
     *
     * Si no puede encontrar el registro a eliminar, {@link NotFoundException}
     * será arrojada.
     *
     * @param ProblemsLanguages $Problems_Languages El objeto de tipo ProblemsLanguages a eliminar
     *
     * @throws NotFoundException Se arroja cuando no se encuentra el objeto a eliminar en la base de datos.
     */
    final public static function delete(ProblemsLanguages $Problems_Languages) : void {
        $sql = 'DELETE FROM `Problems_Languages` WHERE problem_id = ? AND language_id = ?;';
        $params = [$Problems_Languages->problem_id, $Problems_Languages->language_id];
        global $conn;

        $conn->Execute($sql, $params);
        if ($conn->Affected_Rows() == 0) {
            throw new NotFoundException('recordNotFound');
        }
    }

    /**
     * Obtener todas las filas.
     *
     * Esta funcion leerá todos los contenidos de la tabla en la base de datos
     * y construirá un arreglo que contiene objetos de tipo {@link ProblemsLanguages}.
     * Este método consume una cantidad de memoria proporcional al número de
     * registros regresados, así que sólo debe usarse cuando la tabla en
     * cuestión es pequeña o se proporcionan parámetros para obtener un menor
     * número de filas.
     *
     * @param ?int $pagina Página a ver.
     * @param int $filasPorPagina Filas por página.
     * @param ?string $orden Debe ser una cadena con el nombre de una columna en la base de datos.
     * @param string $tipoDeOrden 'ASC' o 'DESC' el default es 'ASC'
     *
     * @return ProblemsLanguages[] Un arreglo que contiene objetos del tipo {@link ProblemsLanguages}.
     *
     * @psalm-return array<int, ProblemsLanguages>
     */
    final public static function getAll(
        ?int $pagina = null,
        int $filasPorPagina = 100,
        ?string $orden = null,
        string $tipoDeOrden = 'ASC'
    ) : array {
        $sql = 'SELECT `Problems_Languages`.`problem_id`, `Problems_Languages`.`language_id` from Problems_Languages';
        global $conn;
        if (!is_null($orden)) {
            $sql .= ' ORDER BY `' . $conn->escape($orden) . '` ' . ($tipoDeOrden == 'DESC' ? 'DESC' : 'ASC');
        }
        if (!is_null($pagina)) {
            $sql .= ' LIMIT ' . (($pagina - 1) * $filasPorPagina) . ', ' . (int)$filasPorPagina;
        }
        $allData = [];
        foreach ($conn->GetAll($sql) as $row) {
            $allData[] = new ProblemsLanguages($row);
        }
        return $allData;
    }

    /**
     * Crear registros.
     *
     * Este metodo creará una nueva fila en la base de datos de acuerdo con los
     * contenidos del objeto ProblemsLanguages suministrado.
     *
     * @param ProblemsLanguages $Problems_Languages El objeto de tipo ProblemsLanguages a crear.
     *
     * @return int Un entero mayor o igual a cero identificando el número de filas afectadas.
     */
    final public static function create(ProblemsLanguages $Problems_Languages) : int {
        $sql = 'INSERT INTO Problems_Languages (`problem_id`, `language_id`) VALUES (?, ?);';
        $params = [
            is_null($Problems_Languages->problem_id) ? null : (int)$Problems_Languages->problem_id,
            is_null($Problems_Languages->language_id) ? null : (int)$Problems_Languages->language_id,
        ];
        global $conn;
        $conn->Execute($sql, $params);
        $affectedRows = $conn->Affected_Rows();
        if ($affectedRows == 0) {
            return 0;
        }

        return $affectedRows;
    }
}
