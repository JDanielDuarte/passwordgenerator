<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerador de Passwords</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <style>                   /*   CSS  */
    .slidecontainer {
      width: 100%;
    }

    .slider {
      -webkit-appearance: none;
      width: 20%;
      height: 25px;
      background: #FFFFFF;
      outline: none;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }

    .slider:hover {
      opacity: 1;
    }

    .slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 25px;
      height: 25px;
      background: #2B65EC;
      cursor: pointer;
    }

    .slider::-moz-range-thumb {
      width: 25px;
      height: 25px;
      background: #2B65EC;
      cursor: pointer;
    }

    span {
      font-weight: bold;
    }

    body {
      background: #ADDFFF;
    }

    #wrong {
      color: #FF0000;
    }

    h1, div, form, input, p {text-align: center;}

  </style>

  </head>

  <body>
    <div id="appid">

      <h1>Gerador de Passwords</h1> <br>

        @csrf

        <div class="slidecontainer">                      <!--  Slider   -->
          Tamanho: &nbsp <span> @{{size}} </span> <br>
          <input type="range" min="5" max="30" class="slider" id="size" v-model="size" name="size">
        </div> <br>
  
        <input type="checkbox" id="lower" checked value="1" @click="checkboxValue(lower)">    <!--  Checkboxes   -->
        <label for="lower"> Minúsculas &nbsp</label>
        <input type="checkbox" id="upper" checked value="1" @click="checkboxValue(upper)">
        <label for="upper"> Maiúsculas &nbsp</label>
        <input type="checkbox" id="numbers" checked value="1" @click="checkboxValue(numbers)">
        <label for="numbers"> Números &nbsp</label>
        <input type="checkbox" id="symbols" checked value="1" @click="checkboxValue(symbols)">
        <label for="symbols"> Símbolos</label><br><br>

        <input type="submit" class="btn btn-primary btn-sm" value="Gerar" @click="generatePassword"/>         <!--  Botão "Gerar"   -->

        <input type="submit" class="btn btn-primary btn-sm" value="Copiar" data-clipboard-target="#psword">   <!-- Botão "Copiar" -->


        <br> <br> <p> <span id="psword" data-clipboard-target="#psword"> @{{password}} </span>
        <br> <span id ="wrong">@{{message}}</span></p>                                 <!-- Espacos para password gerada e mensagens de erro -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    
    <script>

      new ClipboardJS('.btn');

      let app = new Vue({
          el: '#appid',
          data: {
            size: 10,
            message: '',
            password: '',
          },
          methods: {
            generatePassword: function() {
              let vm = this;

              axios.get("{{ route('password.generate') }}", {
                params: {
                  size: vm.size,
                  low: lower.value,
                  upp: upper.value,
                  num: numbers.value,
                  symb: symbols.value
                }
              })
              .then(function (response) {               // Change error handling (create error classes)
                if (response.data == "letterError") {
                  vm.message = "Selecione 1 tamanho de letra";
                }
                else if (Number.isInteger(response.data)) {
                  vm.message = "Aguarde " + response.data + "s para gerar nova password";
                }
                else {
                  vm.message = "";
                  vm.password = response.data;
                }
              })
            
            },

            checkboxValue : function(checkbox) {
              checkbox.value = checkbox.checked ? 1 : 0;
            },

          }
      });

    </script>

  </body>
</html>