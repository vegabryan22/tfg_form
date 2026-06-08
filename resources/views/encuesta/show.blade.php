@extends('layouts.app')
@section('title', 'Encuesta Likert — Estudiantes')

@section('content')
<div class="instrumento-header">
  <h1>Encuesta sobre el Uso de Inteligencia Artificial<br>en el Aprendizaje de Programación</h1>
  <div class="meta">Instrumento 1 · Variable 1 &amp; 3 · Componente cuantitativo · <span>Escala Likert 1–5</span></div>
</div>

<div class="instrumento-body">

  @if($errors->any())
  <div class="alert-error">
    <strong>Por favor corrija los siguientes campos:</strong>
    <ul style="margin-top:8px;padding-left:18px">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="instrucciones">
    <strong>Instrucciones para el/la estudiante</strong>
    El presente instrumento tiene como objetivo conocer tu experiencia con herramientas de Inteligencia Artificial Generativa en tus cursos de programación. No existen respuestas correctas o incorrectas. Tu participación es voluntaria y anónima. Lee cada enunciado con atención y marca la opción que mejor refleje tu situación real. El tiempo estimado de respuesta es de 15 a 20 minutos.
  </div>

  <form action="{{ route('encuesta.store') }}" method="POST" novalidate>
    @csrf

    {{-- FASE --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">FASE DE APLICACIÓN</span>Momento de la investigación</div>
      <div class="campo">
        <label>¿En qué fase de la investigación se aplica este instrumento? <span class="req">*</span></label>
        <select name="fase" required>
          <option value="">Seleccione...</option>
          <option value="pre" {{ old('fase') == 'pre' ? 'selected' : '' }}>Pre-intervención (diagnóstico inicial)</option>
          <option value="post" {{ old('fase') == 'post' ? 'selected' : '' }}>Post-intervención (tras la intervención pedagógica)</option>
        </select>
        @error('fase')<span class="error-msg">{{ $message }}</span>@enderror
      </div>
    </div>

    {{-- SECCIÓN A --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">SECCIÓN A</span>Datos generales del participante</div>

      <div class="campo">
        <label>Institución <span class="req">*</span></label>
        <select name="institucion" required>
          <option value="">Seleccione...</option>
          @foreach(['CTP Roberto Gamboa Valverde','Universidad Latina de Costa Rica','Otra institución'] as $opt)
            <option value="{{ $opt }}" {{ old('institucion') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
          @endforeach
        </select>
        @error('institucion')<span class="error-msg">{{ $message }}</span>@enderror
      </div>

      <div class="grid-2">
        <div class="campo">
          <label>Nivel educativo <span class="req">*</span></label>
          <select name="nivel_educativo" required>
            <option value="">Seleccione...</option>
            @foreach(['9.° año (CTP)','10.° año (CTP)','11.° año (CTP)','12.° año (CTP)','I año universitario','II año universitario','III año universitario','IV año universitario'] as $opt)
              <option value="{{ $opt }}" {{ old('nivel_educativo') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
          @error('nivel_educativo')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Género <span class="req">*</span></label>
          <select name="genero" required>
            <option value="">Seleccione...</option>
            @foreach(['Femenino','Masculino','No binario / otro','Prefiero no indicarlo'] as $opt)
              <option value="{{ $opt }}" {{ old('genero') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
          @error('genero')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="campo">
        <label>Curso actual de programación</label>
        <input type="text" name="curso_actual" value="{{ old('curso_actual') }}" placeholder="Ej. Programación II, BIS04...">
      </div>

      <div class="campo">
        <label>¿Tienes acceso a internet desde tu casa de forma estable? <span class="req">*</span></label>
        <select name="acceso_internet" required>
          <option value="">Seleccione...</option>
          @foreach(['Sí, acceso estable todos los días','Sí, pero con intermitencias frecuentes','Solo mediante datos móviles','No tengo acceso regular'] as $opt)
            <option value="{{ $opt }}" {{ old('acceso_internet') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
          @endforeach
        </select>
        @error('acceso_internet')<span class="error-msg">{{ $message }}</span>@enderror
      </div>
    </div>

    {{-- SECCIÓN B --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">SECCIÓN B</span>Herramientas de IA que utilizas en programación</div>
      <div class="instrucciones" style="font-size:0.83rem">
        <strong>Instrucción</strong>
        Marca todas las herramientas de IA que hayas utilizado al menos una vez en actividades de programación durante el presente ciclo lectivo.
      </div>

      @php
        $tools = ['ChatGPT (OpenAI)','Claude (Anthropic)','Gemini (Google)','GitHub Copilot','Bing / Copilot (Microsoft)','Ninguna'];
        $oldTools = old('herramientas_ia', []);
      @endphp
      <div class="checkbox-grid">
        @foreach($tools as $tool)
          <label class="checkbox-item">
            <input type="checkbox" name="herramientas_ia[]" value="{{ $tool }}" {{ in_array($tool, $oldTools) ? 'checked' : '' }}> {{ $tool }}
          </label>
        @endforeach
      </div>

      <div class="campo">
        <label>Otra herramienta no listada (especifique)</label>
        <input type="text" name="otra_herramienta" value="{{ old('otra_herramienta') }}" placeholder="Nombre de la herramienta...">
      </div>

      <div class="campo">
        <label>¿Con qué frecuencia usas herramientas de IA en actividades de programación? <span class="req">*</span></label>
        <select name="frecuencia_ia" required>
          <option value="">Seleccione...</option>
          @foreach(['Diariamente','Varias veces por semana','Ocasionalmente (menos de una vez por semana)','Nunca o casi nunca'] as $opt)
            <option value="{{ $opt }}" {{ old('frecuencia_ia') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
          @endforeach
        </select>
        @error('frecuencia_ia')<span class="error-msg">{{ $message }}</span>@enderror
      </div>
    </div>

    {{-- SECCIÓN C --}}
    @php
    $itemsC = [
      "Entiendo la diferencia entre una variable, un método y una clase.",
      "Soy capaz de escribir un programa en Java (u otro lenguaje OO) sin ayuda.",
      "Cuando mi código produce un error, sé cómo interpretar el mensaje para encontrar la causa.",
      "Puedo depurar un error en mi código de forma autónoma sin pedir ayuda al docente ni a la IA.",
      "Comprendo qué significa que un sistema tenga 'separación de responsabilidades por capas'.",
      "Sería capaz de diseñar un sistema completo con capa de presentación, lógica de negocio y acceso a datos sin orientación externa.",
    ];
    @endphp
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">SECCIÓN C — Variable 1</span>Uso actual y competencias digitales en programación</div>
      <div class="instrucciones" style="font-size:0.83rem">
        <strong>Instrucción</strong>
        Lee cada enunciado y marca la opción que mejor describe tu situación real. No hay respuestas correctas ni incorrectas.
      </div>
      <div class="escala-ref">
        <span><em>1</em>Totalmente en desacuerdo</span><span><em>2</em>En desacuerdo</span>
        <span><em>3</em>Ni de acuerdo ni en desacuerdo</span><span><em>4</em>De acuerdo</span>
        <span><em>5</em>Totalmente de acuerdo</span>
      </div>
      <div class="likert-wrap">
        <table class="likert-table">
          <thead><tr><th class="th-item">Enunciado</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th></tr></thead>
          <tbody>
            @foreach($itemsC as $i => $item)
              @php $n = $i + 1; $field = "likert_c_{$n}"; @endphp
              <tr>
                <td class="td-item">{{ $item }}</td>
                @for($v = 1; $v <= 5; $v++)
                  <td><input type="radio" name="{{ $field }}" value="{{ $v }}" {{ old($field) == $v ? 'checked' : '' }} required></td>
                @endfor
              </tr>
              @error($field)<tr><td colspan="6"><span class="error-msg">{{ $message }}</span></td></tr>@enderror
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- SECCIÓN D --}}
    @php
    $itemsD = [
      "Utilizo herramientas de IA para resolver dudas sobre la sintaxis de mi lenguaje de programación.",
      "Cuando la IA me genera código, comprendo completamente por qué está escrito de esa manera.",
      "Utilizo la IA para ayudarme a identificar y corregir errores en mis programas.",
      "Uso herramientas de IA para programar sin que mi docente me haya dado orientación sobre cómo hacerlo.",
      "El uso de IA me ha ayudado a aprender mejor programación, no solo a terminar las tareas más rápido.",
      "Me gustaría que el docente me enseñara explícitamente cómo hacer preguntas efectivas a la IA para entender mejor la arquitectura de un programa.",
      "Cuando la IA me da una solución de código, la evalúo críticamente antes de aceptarla.",
      "El uso de IA en clase debería estar acompañado de guías claras del docente sobre cuándo y cómo usarla.",
    ];
    @endphp
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">SECCIÓN D — Variable 1 &amp; 3</span>Percepción del uso pedagógico de la IA generativa</div>
      <div class="escala-ref">
        <span><em>1</em>Totalmente en desacuerdo</span><span><em>2</em>En desacuerdo</span>
        <span><em>3</em>Ni de acuerdo ni en desacuerdo</span><span><em>4</em>De acuerdo</span>
        <span><em>5</em>Totalmente de acuerdo</span>
      </div>
      <div class="likert-wrap">
        <table class="likert-table">
          <thead><tr><th class="th-item">Enunciado</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th></tr></thead>
          <tbody>
            @foreach($itemsD as $i => $item)
              @php $n = $i + 1; $field = "likert_d_{$n}"; @endphp
              <tr>
                <td class="td-item">{{ $item }}</td>
                @for($v = 1; $v <= 5; $v++)
                  <td><input type="radio" name="{{ $field }}" value="{{ $v }}" {{ old($field) == $v ? 'checked' : '' }} required></td>
                @endfor
              </tr>
              @error($field)<tr><td colspan="6"><span class="error-msg">{{ $message }}</span></td></tr>@enderror
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- SECCIÓN E (post-intervención) --}}
    @php
    $itemsE = [
      "Tras participar en las actividades con guías de prompts, comprendo mejor la diferencia entre las capas de un sistema de software.",
      "El uso guiado de la IA me ayudó a entender el propósito arquitectónico del código, no solo su sintaxis.",
      "Ahora soy más capaz de depurar errores de arquitectura de forma autónoma que antes de la intervención.",
      "Cambié la forma en que le hago preguntas a la IA: ahora pido explicaciones de razonamiento en lugar de código directo.",
      "Las actividades de ingeniería de prompts me ayudaron a pensar de manera más estructurada sobre el diseño de software.",
      "Recomendaría el uso de guías de prompts pedagógicos en otros cursos de programación.",
    ];
    @endphp
    <div class="bloque" id="seccion-e">
      <div class="bloque-titulo"><span class="num">SECCIÓN E — Variable 3 (post-intervención)</span>Impacto percibido en el aprendizaje de arquitectura de software</div>
      <div class="instrucciones" style="font-size:0.83rem">
        <strong>Nota</strong>
        Esta sección se aplica únicamente después de completada la fase de intervención pedagógica. Si seleccionaste <em>Pre-intervención</em> arriba, puedes dejar esta sección en blanco.
      </div>
      <div class="escala-ref">
        <span><em>1</em>Totalmente en desacuerdo</span><span><em>2</em>En desacuerdo</span>
        <span><em>3</em>Ni de acuerdo ni en desacuerdo</span><span><em>4</em>De acuerdo</span>
        <span><em>5</em>Totalmente de acuerdo</span>
      </div>
      <div class="likert-wrap">
        <table class="likert-table">
          <thead><tr><th class="th-item">Enunciado</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th></tr></thead>
          <tbody>
            @foreach($itemsE as $i => $item)
              @php $n = $i + 1; $field = "likert_e_{$n}"; @endphp
              <tr>
                <td class="td-item">{{ $item }}</td>
                @for($v = 1; $v <= 5; $v++)
                  <td><input type="radio" name="{{ $field }}" value="{{ $v }}" {{ old($field) == $v ? 'checked' : '' }}></td>
                @endfor
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <p class="nota-pie">Instrumento elaborado por Bryan Vega Rondón (2026) para el Trabajo Final de Graduación de la Licenciatura en Docencia, Universidad San Marcos. Validado por juicio de expertos conforme a Pérez, Pérez y Seca (2020) y Ulate y Vargas (2016).</p>

    <button type="submit" class="btn-submit">Enviar encuesta →</button>
  </form>
</div>
@endsection

@push('scripts')
<script>
  const faseSelect = document.querySelector('select[name="fase"]');
  const secE = document.getElementById('seccion-e');
  function toggleSecE() {
    secE.style.opacity = faseSelect.value === 'post' ? '1' : '0.5';
  }
  faseSelect.addEventListener('change', toggleSecE);
  toggleSecE();
</script>
@endpush
