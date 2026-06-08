@extends('layouts.app')
@section('title', 'Entrevista Semiestructurada — Docentes')

@section('content')
<div class="instrumento-header">
  <h1>Guía de Entrevista Semiestructurada<br>para Docentes de Informática</h1>
  <div class="meta">Instrumento 2 · Variable 2 · Componente cualitativo · <span>Semiestructurada — aprox. 45 min</span></div>
</div>

<div class="instrumento-body">

  @if($errors->any())
  <div class="alert-error">
    <strong>Por favor corrija los siguientes campos:</strong>
    <ul style="margin-top:8px;padding-left:18px">
      @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
  </div>
  @endif

  <div class="instrucciones">
    <strong>Instrucciones para el/la entrevistador/a</strong>
    Esta guía contiene preguntas eje organizadas por categorías temáticas, junto con subpreguntas de profundización. No es obligatorio seguir el orden exacto; el objetivo es generar una conversación natural. Solicite consentimiento informado antes de iniciar. Grabe el audio con autorización del/la participante. Las preguntas en cursiva son sondas opcionales.
  </div>

  <form action="{{ route('entrevista.store') }}" method="POST">
    @csrf

    {{-- DATOS --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">DATOS DEL/LA ENTREVISTADO/A</span>Registro previo a la entrevista</div>
      <div class="grid-2">
        <div class="campo">
          <label>Código de participante <span class="req">*</span></label>
          <input type="text" name="codigo_participante" value="{{ old('codigo_participante') }}" placeholder="D-01, D-02..." required>
          @error('codigo_participante')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Fecha y hora <span class="req">*</span></label>
          <input type="text" name="fecha_hora" value="{{ old('fecha_hora') }}" placeholder="dd/mm/aaaa — HH:MM" required>
          @error('fecha_hora')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Institución <span class="req">*</span></label>
          <select name="institucion" required>
            <option value="">Seleccione...</option>
            @foreach(['CTP Roberto Gamboa Valverde','Universidad Latina de Costa Rica'] as $opt)
              <option value="{{ $opt }}" {{ old('institucion') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
          @error('institucion')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Modalidad <span class="req">*</span></label>
          <select name="modalidad" required>
            <option value="">Seleccione...</option>
            @foreach(['Presencial','Videollamada (Teams / Meet / Zoom)'] as $opt)
              <option value="{{ $opt }}" {{ old('modalidad') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
          @error('modalidad')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Años de experiencia docente en informática <span class="req">*</span></label>
          <select name="years_experiencia" required>
            <option value="">Seleccione...</option>
            @foreach(['Menos de 3 años','3 a 7 años','8 a 15 años','Más de 15 años'] as $opt)
              <option value="{{ $opt }}" {{ old('years_experiencia') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
          @error('years_experiencia')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Cursos que imparte actualmente</label>
          <input type="text" name="cursos_actuales" value="{{ old('cursos_actuales') }}" placeholder="Ej. Programación II, Redes I...">
        </div>
      </div>
    </div>

    {{-- CATEGORÍA 1 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">CATEGORÍA 1</span>Diagnóstico sobre las dificultades de aprendizaje de los estudiantes</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 1.1</div>
        <p class="ptexto">Desde su experiencia docente, ¿cuáles son las principales dificultades que observa en sus estudiantes al aprender programación orientada a objetos?</p>
        <ul class="subpregs">
          <li>¿En qué momento del proceso nota que los estudiantes se "traban" o bloquean con mayor frecuencia?</li>
          <li>¿Hay alguna diferencia entre cómo aprenden la sintaxis y cómo comprenden el diseño de un programa más complejo?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat1_p1" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat1_p1') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 1.2</div>
        <p class="ptexto">¿Ha observado que sus estudiantes tienen dificultad específica para diseñar programas con arquitectura por capas?</p>
        <ul class="subpregs">
          <li>¿Cómo se manifiesta esa dificultad concretamente en el código que entregan?</li>
          <li>¿A partir de qué nivel o curso considera que ese problema se hace más evidente?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat1_p2" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat1_p2') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 1.3</div>
        <p class="ptexto">¿Qué estrategias pedagógicas ha utilizado hasta ahora para ayudar a los estudiantes a superar la brecha entre entender la sintaxis y poder diseñar sistemas completos?</p>
        <ul class="subpregs"><li>¿Qué ha funcionado mejor? ¿Qué no ha dado los resultados esperados?</li></ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat1_p3" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat1_p3') }}</textarea></div>
      </div>
    </div>

    {{-- CATEGORÍA 2 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">CATEGORÍA 2</span>Uso actual de IA generativa por parte del estudiantado</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 2.1</div>
        <p class="ptexto">¿Ha observado que sus estudiantes utilizan herramientas de IA generativa en sus tareas o proyectos de programación?</p>
        <ul class="subpregs">
          <li>¿Con qué frecuencia y para qué tipo de actividades las usan principalmente?</li>
          <li>¿Lo hacen de forma abierta o lo notan de manera indirecta en las entregas?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat2_p1" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat2_p1') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 2.2</div>
        <p class="ptexto">¿Qué problemas o situaciones problemáticas ha identificado a partir de ese uso de IA por parte de los estudiantes?</p>
        <ul class="subpregs">
          <li>¿Ha tenido casos de deshonestidad académica relacionados con el uso de IA?</li>
          <li>¿Nota diferencia entre estudiantes que la usan y los que no en términos de comprensión real?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat2_p2" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat2_p2') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 2.3</div>
        <p class="ptexto">Actualmente, ¿existe alguna normativa institucional o lineamiento docente sobre el uso de IA en sus clases?</p>
        <ul class="subpregs">
          <li>¿Lo permite, lo prohíbe o lo deja al criterio del estudiante?</li>
          <li>¿Ha modificado su forma de evaluar en respuesta al uso de IA?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat2_p3" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat2_p3') }}</textarea></div>
      </div>
    </div>

    {{-- CATEGORÍA 3 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">CATEGORÍA 3</span>Percepción del potencial pedagógico de la IA generativa</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 3.1</div>
        <p class="ptexto">¿Considera que la IA generativa podría tener un uso pedagógico válido en la enseñanza de programación? ¿Por qué sí o por qué no?</p>
        <ul class="subpregs">
          <li>¿En qué tipo de actividades específicas la imagina más útil?</li>
          <li>¿La ve más como una herramienta para el estudiante, para el docente, o para ambos?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat3_p1" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat3_p1') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 3.2</div>
        <p class="ptexto">Si existiera una guía pedagógica que indicara cómo estructurar el uso de IA en sus clases de programación, ¿estaría dispuesto/a a adoptarla?</p>
        <ul class="subpregs">
          <li>¿Qué condiciones deberían cumplirse para que usted la incorporara en su práctica docente?</li>
          <li>¿Qué le generaría más resistencia?</li>
        </ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat3_p2" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat3_p2') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 3.3</div>
        <p class="ptexto">¿Qué diferencia observa entre un estudiante que pide a la IA que le genere el código y uno que le pide que le explique el razonamiento detrás de una decisión de diseño?</p>
        <ul class="subpregs"><li>¿Ha visto estudiantes que usen la IA de esa segunda manera de forma espontánea?</li></ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat3_p3" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat3_p3') }}</textarea></div>
      </div>
    </div>

    {{-- CATEGORÍA 4 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">CATEGORÍA 4</span>Contexto institucional y condiciones de acceso</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 4.1</div>
        <p class="ptexto">¿Sus estudiantes tienen acceso equitativo a dispositivos y conexión a internet dentro y fuera del aula?</p>
        <ul class="subpregs"><li>¿Identifica diferencias significativas entre estudiantes según su zona de residencia o condición socioeconómica?</li></ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat4_p1" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat4_p1') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta eje 4.2</div>
        <p class="ptexto">¿Conoce la Estrategia Nacional de IA del MEP 2026 o alguna directriz similar de su institución sobre el uso de IA en educación?</p>
        <ul class="subpregs"><li>¿Ha recibido alguna capacitación o apoyo institucional para incorporar estas herramientas en su práctica docente?</li></ul>
        <div class="campo"><label>Respuesta del/la entrevistado/a</label><textarea name="resp_cat4_p2" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cat4_p2') }}</textarea></div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta cierre</div>
        <p class="ptexto">¿Hay algo más sobre el tema que considere importante mencionar y que no haya sido abordado en esta conversación?</p>
        <div class="campo"><label>Respuesta de cierre</label><textarea name="resp_cierre" rows="4" placeholder="Registre aquí la respuesta...">{{ old('resp_cierre') }}</textarea></div>
      </div>

      <div class="campo">
        <label>Observaciones adicionales del entrevistador/a</label>
        <textarea name="observaciones" rows="3" placeholder="Observaciones sobre el contexto, actitud del participante, etc.">{{ old('observaciones') }}</textarea>
      </div>
    </div>

    <p class="nota-pie">Guía elaborada por Bryan Vega Rondón (2026). Instrumento cualitativo correspondiente a la Variable 2. Las entrevistas serán grabadas con consentimiento informado y transcritas para análisis temático.</p>
    <button type="submit" class="btn-submit">Guardar registro de entrevista →</button>
  </form>
</div>
@endsection
