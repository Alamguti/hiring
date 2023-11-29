<!-- src/components/Modal.vue -->
<template>
    <div class="modal fade" ref="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <slot></slot>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <!-- Agrega cualquier otro botón o funcionalidad aquí -->
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: String,
    },
    mounted() {
      // Inicializa el modal utilizando Bootstrap
      this.$refs.myModal.addEventListener('hidden.bs.modal', () => {
        // Emitir un evento cuando el modal se cierra
        this.$emit('closed');
      });
    },
  };
  </script>
  
  <style scoped>
  /* Puedes agregar estilos específicos para tu modal aquí si es necesario */
  </style>
  