DELETE FROM carrera WHERE codCarrera = 1; 
DELETE FROM ramo WHERE codRamo = 5;
DELETE FROM alumno WHERE codCarrera = 100;
DELETE FROM comentario WHERE puntuacion = 5;
DELETE FROM alumnorealizacomentario WHERE idComentario = 1;
DELETE FROM alumnopuntuacomentario WHERE matricula = 2;
DELETE FROM habilidad WHERE idHabilidad = 3;
DELETE FROM comentariohabilidad WHERE idHabilidad = 2;
DELETE FROM encuesta WHERE idEncuesta = 15;
DELETE FROM profesor WHERE rutProfesor = '10.000.000-1';
DELETE FROM alumnoencuesta WHERE idEncuesta = 5;
DELETE FROM alumnocomentaprofesor WHERE rutProfesor = '10.000.000-1';
DELETE FROM encuestasobreprofesor WHERE rutProfesor = '10.000.000-1';
DELETE FROM profesortitular WHERE rutTitular = '10.000.000-1';
DELETE FROM profesorasistente WHERE rutAsistente = '10.000.000-1';
DELETE FROM profesorAsociado WHERE rutAsociado = '10.000.000-1';