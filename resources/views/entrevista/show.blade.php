@extends('layouts.app')
@section('title', 'Cuestionario Docente — IA en Programación')

@section('content')
<div class="instrumento-header">
  <h1>Cuestionario de Reflexión Docente<br>sobre IA Generativa en Programación</h1>
  <div class="meta">Instrumento 2 · Variable 2 · Componente cualitativo · <span>Auto-aplicado — aprox. 20–30 min</span></div>
</div>

<div class="instrumento-body">

  @if($errors->any())
  <div class="alert-error">
    <strong>Por favor complete los campos obligatorios:</strong>
    <ul style="margin-top:8px;padding-left:18px">
      @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
  </div>
  @endif

  <div class="instrucciones">
    <strong>Estimado/a docente</strong>
    Este cuestionario forma parte de una investigación sobre el uso de Inteligencia Artificial Generativa en la enseñanza de programación. Sus respuestas son <strong>confidenciales</strong> y se usarán únicamente con fines académicos. No hay respuestas correctas ni incorrectas — lo que se valora es su experiencia y perspectiva real. Puede tomarse el tiempo que necesite. Tiempo estimado: 20 a 30 minutos.
  </div>

  <form action="{{ route('entrevista.store') }}" method="POST">
    @csrf

    {{-- DATOS --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">SECCIÓN A</span>Datos del participante</div>
      <div class="grid-2">
        <div class="campo">
          <label>Fecha de hoy <span class="req">*</span></label>
          <input type="text" name="fecha_hora" value="{{ old('fecha_hora', now()->format('d/m/Y')) }}" placeholder="dd/mm/aaaa" required>
          @error('fecha_hora')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Institución donde imparte clases <span class="req">*</span></label>
          <select name="institucion" required>
            <option value="">Seleccione...</option>
            @foreach(['CTP Roberto Gamboa Valverde','Universidad Latina de Costa Rica'] as $opt)
              <option value="{{ $opt }}" {{ old('institucion') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
          @error('institucion')<span class="error-msg">{{ $message }}</span>@enderror
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
        <div class="campo" style="grid-column:span 2">
          <label>Cursos de programación que imparte actualmente</label>
          <input type="text" name="cursos_actuales" value="{{ old('cursos_actuales') }}" placeholder="Ej. Programación II, Estructuras de Datos, Redes I...">
        </div>
      </div>

      {{-- campo oculto para compatibilidad con BD --}}
      <input type="hidden" name="modalidad" value="Auto-aplicado (en línea)">
    </div>

    {{-- CATEGORÍA 1 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">TEMA 1</span>Dificultades de aprendizaje en programación</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 1.1</div>
        <p class="ptexto">Desde su experiencia, ¿cuáles son las principales dificultades que observa en sus estudiantes al aprender programación orientada a objetos?</p>
        <ul class="subpregs">
          <li>¿En qué momento del proceso nota que los estudiantes se bloquean con mayor frecuencia?</li>
          <li>¿Percibe diferencia entre cómo aprenden la sintaxis y cómo comprenden el diseño de un programa complejo?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat1_p1" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat1_p1') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 1.2</div>
        <p class="ptexto">¿Ha observado que sus estudiantes tienen dificultad específica para diseñar programas con arquitectura por capas (separar presentación, lógica de negocio y acceso a datos)?</p>
        <ul class="subpregs">
          <li>¿Cómo se manifiesta esa dificultad en el código que entregan?</li>
          <li>¿A partir de qué nivel o curso considera que ese problema se hace más evidente?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat1_p2" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat1_p2') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 1.3</div>
        <p class="ptexto">¿Qué estrategias pedagógicas ha utilizado para ayudar a sus estudiantes a superar la brecha entre entender la sintaxis y poder diseñar sistemas completos?</p>
        <ul class="subpregs">
          <li>¿Qué estrategias han funcionado mejor?</li>
          <li>¿Cuáles no han dado los resultados esperados?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat1_p3" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat1_p3') }}</textarea>
        </div>
      </div>
    </div>

    {{-- CATEGORÍA 2 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">TEMA 2</span>Uso de IA generativa por parte de sus estudiantes</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 2.1</div>
        <p class="ptexto">¿Ha observado que sus estudiantes utilizan herramientas de IA generativa (ChatGPT, Claude, Gemini u otras) en sus tareas o proyectos de programación?</p>
        <ul class="subpregs">
          <li>¿Con qué frecuencia y para qué tipo de actividades las usan principalmente?</li>
          <li>¿Lo hacen de forma abierta o lo nota de manera indirecta en las entregas?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat2_p1" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat2_p1') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 2.2</div>
        <p class="ptexto">¿Qué situaciones problemáticas ha identificado a partir del uso de IA por parte de sus estudiantes?</p>
        <ul class="subpregs">
          <li>¿Ha tenido casos de deshonestidad académica relacionados con el uso de IA?</li>
          <li>¿Nota diferencias en la comprensión real del contenido entre estudiantes que usan IA y los que no?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat2_p2" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat2_p2') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 2.3</div>
        <p class="ptexto">En su institución, ¿existe alguna normativa o lineamiento sobre el uso de IA en los cursos de programación?</p>
        <ul class="subpregs">
          <li>¿Lo permite, lo prohíbe, o lo deja al criterio del estudiante?</li>
          <li>¿Ha modificado su forma de evaluar en respuesta al uso de IA por parte de sus estudiantes?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat2_p3" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat2_p3') }}</textarea>
        </div>
      </div>
    </div>

    {{-- CATEGORÍA 3 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">TEMA 3</span>Potencial pedagógico de la IA generativa</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 3.1</div>
        <p class="ptexto">¿Considera que la IA generativa podría tener un uso pedagógico válido en la enseñanza de programación? ¿Por qué sí o por qué no?</p>
        <ul class="subpregs">
          <li>¿En qué tipo de actividades la imagina más útil?</li>
          <li>¿La ve más como una herramienta para el estudiante, para el docente, o para ambos?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat3_p1" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat3_p1') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 3.2</div>
        <p class="ptexto">Si existiera una guía pedagógica con tipos de prompts sugeridos para cada actividad de sus clases de programación, ¿estaría dispuesto/a a adoptarla?</p>
        <ul class="subpregs">
          <li>¿Qué condiciones deberían cumplirse para que usted la incorporara en su práctica?</li>
          <li>¿Qué le generaría más resistencia?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat3_p2" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat3_p2') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 3.3</div>
        <p class="ptexto">¿Qué diferencia observa entre un estudiante que le pide a la IA que le genere el código directamente, y uno que le pide que le explique el razonamiento detrás de una decisión de diseño?</p>
        <ul class="subpregs">
          <li>¿Ha visto estudiantes que usen la IA de esa segunda manera de forma espontánea?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat3_p3" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat3_p3') }}</textarea>
        </div>
      </div>
    </div>

    {{-- CATEGORÍA 4 --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">TEMA 4</span>Contexto institucional y acceso tecnológico</div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 4.1</div>
        <p class="ptexto">¿Sus estudiantes tienen acceso equitativo a dispositivos y conexión a internet dentro y fuera del aula?</p>
        <ul class="subpregs">
          <li>¿Identifica diferencias significativas entre estudiantes según su zona de residencia o condición socioeconómica?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat4_p1" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat4_p1') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Pregunta 4.2</div>
        <p class="ptexto">¿Conoce la Estrategia Nacional de IA del MEP 2026 o alguna directriz similar de su institución sobre el uso de IA en educación?</p>
        <ul class="subpregs">
          <li>¿Ha recibido capacitación o apoyo institucional para incorporar herramientas de IA en su práctica docente?</li>
        </ul>
        <div class="campo">
          <label>Su respuesta</label>
          <textarea name="resp_cat4_p2" rows="5" placeholder="Escriba aquí su respuesta...">{{ old('resp_cat4_p2') }}</textarea>
        </div>
      </div>

      <div class="pregunta-entrevista">
        <div class="pnum">Para cerrar</div>
        <p class="ptexto">¿Hay algo más sobre el tema — la enseñanza de programación con IA — que considere importante compartir y que no haya sido abordado en las preguntas anteriores?</p>
        <div class="campo">
          <label>Su respuesta (opcional)</label>
          <textarea name="resp_cierre" rows="4" placeholder="Cualquier comentario adicional es bienvenido...">{{ old('resp_cierre') }}</textarea>
        </div>
      </div>

      {{-- campo oculto: observaciones ya no aplican en auto-aplicado --}}
      <input type="hidden" name="observaciones" value="">
    </div>

    <p class="nota-pie">Cuestionario elaborado por Bryan Vega Rondón (2026) para el Trabajo Final de Graduación de la Licenciatura en Docencia, Universidad San Marcos. Sus respuestas son confidenciales y se utilizarán únicamente con fines académicos. Instrumento cualitativo correspondiente a la Variable 2 (Estrategias pedagógicas mediadas por IA).</p>
    <button type="submit" class="btn-submit">Enviar mis respuestas →</button>
  </form>
</div>
@endsection

@push('scripts')
<script>
  // Pre-rellena la fecha si el campo está vacío
  const fechaInput = document.querySelector('input[name="fecha_hora"]');
  if (!fechaInput.value) {
    const hoy = new Date();
    fechaInput.value = hoy.toLocaleDateString('es-CR', { day:'2-digit', month:'2-digit', year:'numeric' });
  }
</script>
@endpush
