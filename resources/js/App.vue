<template>
  <div class="container">
    <div class="col-12">
      <prueba-component></prueba-component>
      <div class="row">
        <!-- <h1 class="text-center text-white p-5">Tareas</h1> -->
      </div>
      <!-- Formulario para agregar nuevas tareas -->
      <div class="row">
        <div class="col-8 offset-2 pt-5">
          <!-- <h2 class="text-center text-white">Agregar Nueva Tarea</h2> -->

          <form @submit.prevent="agregarTarea">
            <div class="mb-3">
              <label for="tarea" class="form-label text-white">Nombre de la Tarea</label>
              <input type="text" class="form-control" id="tarea" v-model="nuevaTarea" required />
            </div>
            <button type="submit" class="btn btn-success">Agregar Tarea</button>
          </form>
        </div>
      </div>

      <!-- Agregar tabla de tareas -->
      <div class="row">
        <div class="col-8 offset-2">
          <h2 class="text-center text-white pb-3">Lista de Tareas</h2>

          <!-- Tabla de tareas con Bootstrap -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tarea</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Utilizar v-for para iterar sobre las tareas -->
              <tr v-for="(tarea, index) in tareas" :key="index">
                <th class="col-2" scope="row">{{ tarea.id }}</th>
                <td class="col-6">{{ tarea.nombre }}</td>
                <td class="col-4">
                  <button @click="abrirModalForm(index)" type="button" class="btn btn-primary">
                    Editar
                  </button>
                  &nbsp;
                  <button @click="eliminarTarea(index)" type="button" class="btn btn-danger">
                    Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div ref="modal" class="modal fade" id="modal" tabindex="-1" :class={show:showModal}
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
            <button @click="cerrarModal()" type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{ resposneMessage }}
          </div>
          <div class="modal-footer">
            <button @click="cerrarModal()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div ref="modalForm" class="modal fade" id="modalForm" tabindex="-1" :class={show:showModalForm}
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Tarea</h5>
            <button @click="cerrarModalForm()" type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" @submit.prevent="editarTarea">
              <div>
                <label for="editarTarea" class="form-label text-white">Editar Tarea</label>
                <input type="text" class="form-control" id="editarTarea" v-model="tareaEditada.nombre" required />
                <br>
                <button type="submit" class="btn btn-primary">Guardar Tarea</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button @click="cerrarModalForm()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


  </div>
</template>

<script>

export default {

  data() {
    return {
      nuevaTarea: "", // Almacena el nombre de la nueva tarea
      tareas: [], // Almacena la lista de tareas
      usuario: {},
      resposneMessage: "",
      showModal: false,
      showModalForm: false,
      tareaSeleccionada: {},
      tareaEditada:{},
      indexSelecionado: null
    };
  },
  mounted() {
    this.listarTareas()
    this.usuario = this.$user;
    var myModal = document.getElementById('modal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
      myInput.focus()
    })

  },
  methods: {

    async listarTareas() {
      try {
        const response = await fetch('api/tareas')

        if (response.ok) {
          const data = await response.json()
          this.tareas = data
        }

      } catch (error) {
        console.error('Error al cargar tareas:', error)
      }
    },
    async agregarTarea() {
      try {
        const response = await fetch('api/agregar-tarea', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            nombre: this.nuevaTarea,
            usuario: this.usuario
          }),
        })
        if (response.ok) {
          const responseData = await response.json()

          this.resposneMessage = responseData.message

          this.tareas.push(responseData.tarea)
          this.nuevaTarea = ""
          this.abrirModal('modal')
        }


      } catch (error) {
        console.error('Error al agregar Tarea:', error)
      }

    },
    async editarTarea() {

      try {
        const response = await fetch(`api/editar-tarea/${this.tareaEditada.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            nombre: this.tareaEditada.nombre,
          }),
        });

        if (response.ok) {
          const responseData = await response.json();
          this.resposneMessage = responseData.message;
          // Actualiza la lista de tareas después de editar
          this.listarTareas();
          this.abrirModal()
        }
      } catch (error) {
        console.error('Error al editar la tarea:', error);
      }

      // Cierra el modal después de guardar cambios o manejar errores
      this.cerrarModalForm()
    },
    async eliminarTarea(index) {
      const tareaId = this.tareas[index].id

      try {
        const response = await fetch(`api/eliminar-tarea/${tareaId}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
          }
        })
        if (response.ok) {
          const responseData = await response.json()

          this.resposneMessage = responseData.message
          this.listarTareas()
          this.abrirModal('modal')
        }

      } catch (error) {
        console.error('Error al eliminar la tarea:', error);
      }
    },
    abrirModal(refName) {
      this.showModal = true;


      this.$refs.modal.classList.remove('show', 'fade');
      this.$refs.modal.setAttribute('aria-hidden', 'true');
      this.$refs.modalForm.classList.remove('show', 'fade');
      this.$refs.modalForm.setAttribute('aria-hidden', 'true');

      // Mostrar el modal correspondiente
      const modal = document.getElementById(refName);
      if(modal){
        modal.classList.add('show', 'fade');
        modal.setAttribute('aria-hidden', 'false');
        modal.focus();
      }
     

    },

    cerrarModal() {
      this.showModal = false
    },
    cerrarModalForm(){
      this.showModalForm = false
    },
    abrirModalForm(index) {
      this.showModalForm = true
      this.indexSelecionado = index;
      this.tareaEditada = {...this.tareas[index]}
      // this.abrirModal('modalForm');
    }
  }
}
</script>

<style>
.modal {
  display: none;
}

.show {
  display: block;
}
</style>

