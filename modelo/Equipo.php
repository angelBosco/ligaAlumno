<?php
//aqui se conecta la conexion.
include_once 'Conexion.php';
class Equipo
{
    public $id;
    public $nombre;
    public $puntos;
    public $golesFavor;
    public $golesContra;

    /*private $id;
    private $nombre;
    private $puntos;
    private $golesFavor;
    private $golesContra;*/

    //No defino constructor para poder usar $resul->fetchAll(PDO::FETCH_CLASS, 'Equipo'); de forma sencilla
    /*public function __construct(
        string $nombre,
        int $puntos,
        $golesFavor,
        $golesContra,
        $id = -1
    ) {
        $this->nombre = $nombre;
        $this->puntos = $puntos;
        $this->golesFavor = $golesFavor;
        $this->golesContra = $golesContra;
        $this->id = $id;
    }*/

    public function get_id()
    {
        return $this->id;
    }
    public function get_nombre()
    {
        return $this->nombre;
    }
    public function get_puntos()
    {
        return $this->puntos;
    }
    public function get_golesFavor()
    {
        return $this->golesFavor;
    }
    public function get_golesContra()
    {
        return $this->golesContra;
    }

    public function insertarEnBd()
    {
        //aqui se crea la conexion con la base de datos
        $c = new Conexion();
        //aqui conectas la funcion de conexion
        // -> es un operador de acceso a miembro que se utiliza para acceder a propiedades y métodos de un objeto. 
        $conex = $c->connect();
        // y aqui le asignamos variables para no teclear tanto
        $nom = $this->nombre;
        $pun = $this->puntos;
        $gf = $this->golesFavor;
        $gc = $this->golesContra;
        //creamos una variable para las inserciones
        $sql = "INSERT INTO equipos (nombre, puntos, golesFavor, golesContra) 
        VALUES ('$nom','$pun', '$gf', '$gc')";
        // $conex->exec($sql) el método exec() ejecuta la consulta SQL del objeto $conex 
        //(presumiblemente un objeto de conexión a la base de datos PDO o MySQLi), 
        //y el resultado se almacena en $resul.
        $resul = $conex->exec($sql);
        // echo "se han insertado $resul registros";
        return $resul;
    }
    public static function insertarAlEnBd($eq)
    {
        $c = new Conexion();
        $conex = $c->connect();
        $nom = $eq->nombre;
        $pun = $eq->puntos;
        $gf = $eq->golesfavor;
        $gc = $eq->golesContra;

        $sql = "INSERT INTO equipos (nombre, puntos, golesFavor, golesContra) 
        VALUES ('$nom','$pun', '$gf', '$gc')";
        $resul = null;
        try {
            $resul = $conex->exec($sql);
        } catch (PDOException $e) {
            print_r('Error al insertar :' . $e->getMessage());
        }
        return $resul;
    }
    public function modificarEnBd()
    {
        $c = new Conexion();
        $conex = $c->connect();
        $id = $this->id;
        $nom = $this->nombre;
        $pun = $this->puntos;
        $gf = $this->golesFavor;
        $gc = $this->golesContra;
        $sql = "UPDATE equipos SET nombre= '$nom', puntos = '$pun', golesFavor = '$gf', golesContra = '$gc' where id = '$id'";
        $resul = $conex->exec($sql);
        return $resul;
    }
    //La función getPelicula($id) devuelve el objeto alumno que tiene como id el parámetro pasado.
    // este van sin s y con un parametro. Aqui pides solo un alumno, y te devuelve el alumno con ese id.
    public static function getEquipo($id)
    {
        //cuando trabaje con select, se trabaja con query
        $c = new Conexion();
        $connex = $c->connect();
        $sql = "SELECT * FROM equipos WHERE id=$id";
        $result = $connex->query($sql);
        //$result no es un objeto, es un array de objetos PDO que encapsula a un registro de la tabla
        $equi = null;
        while ($r = $result->fetch(PDO::FETCH_OBJ)) {
            /*$nom = $r->nombre;
            $pun = $r->puntos;
            $gf = $r->golesFavor;
            $gc = $r->golesContra;
            $equi = new Equipo($nom, $pun, $gf, $gc, $id);*/
            $equi = new Equipo();
            $equi->nombre = $r->nombre;
            $equi->puntos = $r->puntos;
            $equi->golesFavor = $r->golesFavor;
            $equi->golesContra = $r->golesContra;
            $equi->id = $r->id;
        }
        return $equi;
    }
    //la función getAlumnos devuelve un array de objetos Alumno
    //devuelve todos los alumnos en formato alumnos en un array
    public static function getEquipos()
    {
        $Equip = array();
        $c = new Conexion();
        $conex = $c->connect();
        $sql = "SELECT * from equipos";
        //lo que me devulve lo guardo en resul
        //QUERY es para ejecutar y consultar datos solo, no para modeificar ni eliminar, el tal caso se usaria exec
        $resul = $conex->query($sql);
        //Compruebo que devuelve alguna línea
        //cualquier numero mayor que 0 es verdadero, y si es 0 es falso, entonces si hay 0 filas no entrará
        if ($resul->rowCount()) {
            //Mientras queden líneas o registros, los saco en forma de objetos PDO y creo objetos Alumno
            //fetch lo que hace es sacar un registro en forma PDO, pdo puede sacarte los registros de cualquier 
            //manera, entonces tenemos que indicarle de que manera quiero que me lo devuelva, 
            //este caso como un objeto. constante estatica de la clase pdo.
            while ($row = $resul->fetch(PDO::FETCH_OBJ)) {
                //que es lo que quiero? crear un alumno de mi mundo
                //$Equip[] = new Equipo($row->nombre, $row->puntos, $row->golesFavor, $row->golesContra, $row->id);
                $equi = new Equipo();
                $equi->nombre = $row->nombre;
                $equi->puntos = $row->puntos;
                $equi->golesFavor = $row->golesFavor;
                $equi->golesContra = $row->golesContra;
                $equi->id = $row->id;
                $Equip[] = $equi;
            }
        }
        return $Equip;
    }
    public static function getEquiposClass()
    {
        //$Equip = array();
        $equipos = null;
        $c = new Conexion();
        $conex = $c->connect();
        $sql = "SELECT * from equipos";
        //lo que me devulve lo guardo en resul
        //QUERY es para ejecutar y consultar datos solo, no para modeificar ni eliminar, el tal caso se usaria exec
        //$resul = $conex->query($sql);
        //uso de consultas preparadas por seguridad
        $stmt = $conex->prepare($sql);
        $resul = $stmt->execute();
        //Compruebo si ha habido errores en la ejecución
        //si hay errores devuelve falso y si todo va bien, devuelve verdadero
        if ($resul) {
            //obtener todos los registros de la tabla que satisfagan el select, pero como array de objetos de 'Equipo'
            $equipos = $stmt->fetchAll(PDO::FETCH_CLASS, 'Equipo');
            //Mientras queden líneas o registros, los saco en forma de objetos PDO y creo objetos Alumno
            //fetch lo que hace es sacar un registro en forma PDO, pdo puede sacarte los registros de cualquier 
            //manera, entonces tenemos que indicarle de que manera quiero que me lo devuelva, 
            //este caso como un objeto. constante estatica de la clase pdo.
            //while ($row = $resul->fetch(PDO::FETCH_OBJ)) {
            //que es lo que quiero? crear un alumno de mi mundo
            //$Equip[] = new Equipo($row->nombre, $row->puntos,$row->golesFavor,$row->golesContra, $row->id);
            //}
        }
        return $equipos;
    }
    public static function eliminarDeBd(int $id)
    //se le pasa un id, para identificar el alumno que hay que eliminar
    {
        $c = new Conexion();
        //aqui ya conecto con la bd, y la guardo en una variable
        $conex = $c->connect();
        $sql = "DELETE FROM equipos WHERE id=$id";
        $resul = $conex->exec($sql);
        // echo "se han borrado $resul registros";
        //si ha eliminado devuelve un 1 y si no lo ha encontrado 0
        return $resul;
    }

    public static function getEquipoPorNombre($nombre)
    {
        $c = new Conexion();
        $connex = $c->connect();
        $sql = "SELECT * FROM equipos WHERE nombre = '$nombre'";
        $result = $connex->query($sql);
        $equi = null;
        while ($r = $result->fetch(PDO::FETCH_OBJ)) {
            //$equipo = new Equipo($r->nombre, $r->puntos, $r->golesFavor, $r->golesContra);
            $equi = new Equipo();
            $equi->nombre = $r->nombre;
            $equi->puntos = $r->puntos;
            $equi->golesFavor = $r->get_golesFavor;
            $equi->golesContra = $r->golesContra;
            $equi->id = $r->id;
        }
        return $equi;
    }
    public function sumarPuntos($puntos)
    {
        $c = new Conexion();
        $conex = $c->connect();
        $sql = "UPDATE equipos SET puntos = puntos + $puntos where id=$this->id";
        $resul = $conex->exec($sql);
    }
}
