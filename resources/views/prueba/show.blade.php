@extends('layouts.app')
@section('title', 'Prueba Diagnóstica — Programación')

@section('content')
<div class="instrumento-header">
  <h1>Prueba Diagnóstica de Competencias<br>en Programación Orientada a Objetos</h1>
  <div class="meta">Instrumento 3 · Variable 1 &amp; 3 · Componente cuantitativo · <span>60 minutos · 100 puntos</span></div>
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
    <strong>Instrucciones generales</strong>
    Esta prueba evalúa tres dimensiones de competencia en programación: (A) manejo de sintaxis básica, (B) capacidad de depuración autónoma, y (C) comprensión de arquitectura de software por capas. Responde de forma individual y sin consultar herramientas de IA. Tiempo: 60 minutos. Puntaje total: 100 puntos.
  </div>

  <form action="{{ route('prueba.store') }}" method="POST">
    @csrf

    <div class="bloque">
      <div class="bloque-titulo"><span class="num">IDENTIFICACIÓN</span>Datos del participante</div>
      <div class="instrucciones" style="font-size:0.83rem;margin-bottom:20px">
        <strong>Importante</strong>
        Usa el <strong>mismo código</strong> que el investigador te asignó. Este código vincula esta prueba con tu encuesta para el análisis pre/post, manteniendo tu anonimato.
      </div>
      <div class="grid-2">
        <div class="campo" style="grid-column:span 2">
          <label>Tu código de participante <span class="req">*</span></label>
          <input type="text" name="codigo_participante" value="{{ old('codigo_participante') }}"
            placeholder="Ej. E-01, E-12..." required maxlength="20"
            style="font-family:'JetBrains Mono',monospace;font-size:1rem;letter-spacing:0.05em;max-width:240px">
          @error('codigo_participante')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Fase <span class="req">*</span></label>
          <select name="fase" required>
            <option value="">Seleccione...</option>
            <option value="pre" {{ old('fase') == 'pre' ? 'selected' : '' }}>Pre-intervención (diagnóstico)</option>
            <option value="post" {{ old('fase') == 'post' ? 'selected' : '' }}>Post-intervención</option>
          </select>
          @error('fase')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
          <label>Institución</label>
          <select name="institucion">
            <option value="">Seleccione...</option>
            @foreach(['CTP Roberto Gamboa Valverde','Universidad Latina de Costa Rica','Otra institución'] as $opt)
              <option value="{{ $opt }}" {{ old('institucion') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="campo">
          <label>Nivel educativo</label>
          <select name="nivel_educativo">
            <option value="">Seleccione...</option>
            @foreach(['9.° año (CTP)','10.° año (CTP)','11.° año (CTP)','12.° año (CTP)','I año universitario','II año universitario','III año universitario','IV año universitario'] as $opt)
              <option value="{{ $opt }}" {{ old('nivel_educativo') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    {{-- DIMENSIÓN A --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">DIMENSIÓN A · 30 puntos</span>Manejo de sintaxis básica en programación orientada a objetos</div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta">A1 · Sintaxis</div>
        <h4>Definición de clase con atributos y constructor</h4>
        <p style="font-size:0.87rem;margin-bottom:10px">Escribe en Java una clase llamada <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">Producto</code> con atributos <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">id</code> (entero), <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">nombre</code> (String) y <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">precio</code> (double). Incluye: constructor con todos los parámetros, métodos getters y un método <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">toString()</code>.</p>
        <div class="campo"><label>Código de respuesta:</label><textarea name="resp_a1" rows="8" placeholder="public class Producto {&#10;    // Tu código aquí&#10;}">{{ old('resp_a1') }}</textarea></div>
      </div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta">A2 · Sintaxis</div>
        <h4>Herencia y polimorfismo</h4>
        <p style="font-size:0.87rem;margin-bottom:10px">Crea una subclase <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">ProductoDigital</code> que agregue el atributo <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">urlDescarga</code> (String). Sobreescribe el método <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">toString()</code>.</p>
        <div class="campo"><label>Código de respuesta:</label><textarea name="resp_a2" rows="8" placeholder="public class ProductoDigital extends Producto {&#10;    // Tu código aquí&#10;}">{{ old('resp_a2') }}</textarea></div>
      </div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta">A3 · Sintaxis</div>
        <h4>Uso de colecciones y ciclos</h4>
        <p style="font-size:0.87rem;margin-bottom:10px">Escribe un fragmento que: (1) cree un <code style="font-family:JetBrains Mono,monospace;background:#eee;padding:2px 5px;border-radius:3px">ArrayList&lt;Producto&gt;</code>, (2) agregue tres productos, y (3) recorra la lista imprimiendo nombre y precio de cada uno.</p>
        <div class="campo"><label>Código de respuesta:</label><textarea name="resp_a3" rows="8" placeholder="// Tu código aquí">{{ old('resp_a3') }}</textarea></div>
      </div>
    </div>

    {{-- DIMENSIÓN B --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">DIMENSIÓN B · 30 puntos</span>Capacidad de depuración autónoma</div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta dim2">B1 · Depuración</div>
        <h4>Identificación de errores de compilación</h4>
        <p style="font-size:0.87rem;margin-bottom:6px">El siguiente código contiene <strong>3 errores de sintaxis</strong>. Identifícalos, explica por qué es un error y escribe la corrección.</p>
        <div class="codigo"><span class="kw">public class</span> <span class="cls">Calculadora</span> {
    <span class="kw">private int</span> resultado

    <span class="kw">public</span> <span class="cls">Calculadora</span>() {
        resultado = <span class="str">0</span>;
    }

    <span class="kw">public void</span> <span class="fn">sumar</span>(<span class="kw">int</span> a, <span class="kw">int</span> b) {
        resultado = a + b
    }

    <span class="kw">public int</span> <span class="fn">getResultado</span>(<span class="kw">int</span> x) {
        <span class="kw">return</span> resultado;
    }
}</div>
        <div class="campo"><label>Error 1 — Línea, descripción y corrección:</label><textarea name="resp_b1_error1" rows="3" placeholder="Línea: ___  Error: ___  Corrección: ___">{{ old('resp_b1_error1') }}</textarea></div>
        <div class="campo"><label>Error 2 — Línea, descripción y corrección:</label><textarea name="resp_b1_error2" rows="3" placeholder="Línea: ___  Error: ___  Corrección: ___">{{ old('resp_b1_error2') }}</textarea></div>
        <div class="campo"><label>Error 3 — Línea, descripción y corrección:</label><textarea name="resp_b1_error3" rows="3" placeholder="Línea: ___  Error: ___  Corrección: ___">{{ old('resp_b1_error3') }}</textarea></div>
      </div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta dim2">B2 · Depuración</div>
        <h4>Identificación de errores lógicos en tiempo de ejecución</h4>
        <p style="font-size:0.87rem;margin-bottom:6px">El siguiente método compila sin errores, pero produce un resultado incorrecto. Describe qué resultado produce, cuál debería ser el correcto, y cuál es la causa del error lógico.</p>
        <div class="codigo"><span class="kw">public int</span> <span class="fn">calcularPromedio</span>(<span class="kw">int</span>[] numeros) {
    <span class="kw">int</span> suma = <span class="str">0</span>;
    <span class="kw">for</span> (<span class="kw">int</span> i = <span class="str">0</span>; i &lt; numeros.length; i++) {
        suma = numeros[i]; <span class="cm">// ← observa esta línea</span>
    }
    <span class="kw">return</span> suma / numeros.length;
}</div>
        <div class="campo"><label>¿Qué resultado produce el código tal como está?</label><textarea name="resp_b2_resultado" rows="3" placeholder="Explica con tus propias palabras...">{{ old('resp_b2_resultado') }}</textarea></div>
        <div class="campo"><label>¿Cuál debería ser el resultado correcto y cómo se corrige?</label><textarea name="resp_b2_correccion" rows="3" placeholder="Corrección propuesta:">{{ old('resp_b2_correccion') }}</textarea></div>
      </div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta dim2">B3 · Depuración</div>
        <h4>Lectura e interpretación de un stack trace</h4>
        <div class="codigo"><span class="cm">Exception in thread "main" java.lang.NullPointerException</span>
    at <span class="cls">ServicioCliente</span>.<span class="fn">buscarPorId</span>(<span class="cls">ServicioCliente</span>.java:<span class="str">34</span>)
    at <span class="cls">Main</span>.<span class="fn">main</span>(<span class="cls">Main</span>.java:<span class="str">12</span>)</div>
        <div class="campo"><label>¿En qué archivo y línea ocurre el error?</label><input type="text" name="resp_b3_archivo" value="{{ old('resp_b3_archivo') }}" placeholder="Tu respuesta..."></div>
        <div class="campo"><label>¿Qué significa un <em>NullPointerException</em> en Java?</label><input type="text" name="resp_b3_npe" value="{{ old('resp_b3_npe') }}" placeholder="Tu respuesta..."></div>
        <div class="campo"><label>¿Cuáles serían las primeras dos acciones que tomarías para diagnosticar la causa?</label><textarea name="resp_b3_acciones" rows="3" placeholder="Acción 1:&#10;Acción 2:">{{ old('resp_b3_acciones') }}</textarea></div>
      </div>
    </div>

    {{-- DIMENSIÓN C --}}
    <div class="bloque">
      <div class="bloque-titulo"><span class="num">DIMENSIÓN C · 40 puntos</span>Comprensión de arquitectura de software por capas</div>

      <div class="ejercicio">
        <div class="pts">10 pts</div>
        <div class="etiqueta dim3">C1 · Arquitectura</div>
        <h4>Identificación de capas en un sistema existente</h4>
        <p style="font-size:0.87rem;margin-bottom:10px">Indica a qué capa arquitectónica pertenece cada clase: <strong>Presentación (UI)</strong>, <strong>Lógica de Negocio (BLL)</strong> o <strong>Acceso a Datos (DAL/DAO)</strong>.</p>
        <table style="width:100%;border-collapse:collapse;font-size:0.84rem">
          <thead><tr style="background:var(--azul);color:#fff">
            <th style="padding:8px 12px;text-align:left">Clase y descripción</th>
            <th style="padding:8px;text-align:center;width:160px">Capa</th>
          </tr></thead>
          <tbody>
            @php
            $clases = [
              'resp_c1_clientedao'      => ['ClienteDAO', 'conecta a la base de datos y ejecuta consultas SQL para gestionar clientes'],
              'resp_c1_formulario'      => ['FormularioRegistro', 'muestra campos de texto al usuario y captura sus datos de entrada'],
              'resp_c1_serviciofactura' => ['ServicioFactura', 'calcula impuestos, aplica descuentos y valida los datos de una factura'],
              'resp_c1_panelprincipal'  => ['PanelPrincipal', 'menú de navegación que redirige al usuario entre módulos del sistema'],
              'resp_c1_productorepo'    => ['ProductoRepository', 'realiza operaciones CRUD sobre la tabla Productos en MySQL'],
            ];
            @endphp
            @foreach($clases as $field => [$nombre, $desc])
            <tr style="border-bottom:1px solid var(--borde)">
              <td style="padding:10px 12px"><code style="font-family:JetBrains Mono,monospace">{{ $nombre }}</code> — {{ $desc }}</td>
              <td><input type="text" name="{{ $field }}" value="{{ old($field) }}" style="width:100%;border:1px solid var(--borde);padding:6px;font-size:0.83rem;background:var(--crema);border-radius:4px" placeholder="Capa..."></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="ejercicio">
        <div class="pts">15 pts</div>
        <div class="etiqueta dim3">C2 · Arquitectura</div>
        <h4>Análisis de violaciones a la separación de capas</h4>
        <p style="font-size:0.87rem;margin-bottom:6px">El siguiente fragmento viola el principio de separación de responsabilidades. Identifica al menos <strong>dos violaciones</strong>, explica por qué son un problema y propone cómo corregirlas.</p>
        <div class="codigo"><span class="kw">public class</span> <span class="cls">FormularioPedido</span> {   <span class="cm">// clase de la capa UI</span>

    <span class="kw">public void</span> <span class="fn">guardarPedido</span>(<span class="kw">String</span> producto, <span class="kw">int</span> cantidad) {
        <span class="cm">// Validación de negocio directamente en la UI</span>
        <span class="kw">if</span> (cantidad &lt;= <span class="str">0</span>) {
            System.out.println(<span class="str">"Cantidad inválida"</span>);
            <span class="kw">return</span>;
        }
        <span class="cm">// Conexión a BD directamente desde la UI</span>
        Connection conn = DriverManager.<span class="fn">getConnection</span>(
            <span class="str">"jdbc:mysql://localhost/tienda"</span>, <span class="str">"root"</span>, <span class="str">"1234"</span>);
        PreparedStatement ps = conn.<span class="fn">prepareStatement</span>(
            <span class="str">"INSERT INTO pedidos VALUES (?,?)"</span>);
        ps.<span class="fn">setString</span>(<span class="str">1</span>, producto);
        ps.<span class="fn">setInt</span>(<span class="str">2</span>, cantidad);
        ps.<span class="fn">executeUpdate</span>();
    }
}</div>
        <div class="campo"><label>Violación 1 — descripción y corrección propuesta:</label><textarea name="resp_c2_violacion1" rows="4" placeholder="Qué viola: ___&#10;Por qué es un problema: ___&#10;Cómo se corrige: ___">{{ old('resp_c2_violacion1') }}</textarea></div>
        <div class="campo"><label>Violación 2 — descripción y corrección propuesta:</label><textarea name="resp_c2_violacion2" rows="4" placeholder="Qué viola: ___&#10;Por qué es un problema: ___&#10;Cómo se corrige: ___">{{ old('resp_c2_violacion2') }}</textarea></div>
      </div>

      <div class="ejercicio">
        <div class="pts">15 pts</div>
        <div class="etiqueta dim3">C3 · Arquitectura</div>
        <h4>Diseño de un sistema simple con arquitectura por capas</h4>
        <p style="font-size:0.87rem;margin-bottom:10px">Diseña la estructura de clases para un sistema de <strong>registro de estudiantes</strong> que permita: guardar un nuevo estudiante, buscar por cédula, y mostrar la lista de estudiantes registrados.</p>
        <div class="campo">
          <label>1. Lista las clases que crearías (nombre, capa y responsabilidad):</label>
          <textarea name="resp_c3_clases" rows="5" placeholder="Clase: EstudianteDAO — Capa: Acceso a Datos — Responsabilidad: ...&#10;Clase: _______________">{{ old('resp_c3_clases') }}</textarea>
        </div>
        <div class="campo">
          <label>2. Describe el flujo cuando el usuario presiona "Guardar nuevo estudiante". ¿Qué sucede en cada capa?</label>
          <textarea name="resp_c3_flujo" rows="5" placeholder="1. En la capa de Presentación: ...&#10;2. En la capa de Lógica de Negocio: ...&#10;3. En la capa de Acceso a Datos: ...">{{ old('resp_c3_flujo') }}</textarea>
        </div>
        <div class="campo">
          <label>3. ¿Por qué es importante que la capa de presentación NO se comunique directamente con la capa de acceso a datos?</label>
          <textarea name="resp_c3_justificacion" rows="4" placeholder="Tu explicación...">{{ old('resp_c3_justificacion') }}</textarea>
        </div>
      </div>
    </div>

    <p class="nota-pie">Prueba diseñada por Bryan Vega Rondón (2026). Variable 1 y Variable 3. Aplicable como diagnóstico pre-intervención y como medición post-intervención. La rúbrica de corrección se entrega en documento separado al evaluador.</p>
    <button type="submit" class="btn-submit">Enviar prueba →</button>
  </form>
</div>
@endsection
