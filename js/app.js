document.addEventListener('DOMContentLoaded', function(){
  const registerForm = document.getElementById('register-form');
  const loginForm = document.getElementById('login-form');
  const createForm = document.getElementById('product-create-form');
  const editForm = document.getElementById('product-edit-form');

  function showAlert(msg){ alert(msg); }

  if (registerForm){
    registerForm.addEventListener('submit', function(e){
      const email = registerForm.querySelector('input[name="email"]').value.trim();
      const pass = registerForm.querySelector('input[name="password"]').value;
      const name = registerForm.querySelector('input[name="name"]').value.trim();
      if (!name || !/^\S+@\S+\.\S+$/.test(email) || pass.length < 4){
        e.preventDefault(); showAlert('Preencha nome, e-mail válido e senha com ao menos 4 caracteres.');
      }
    });
  }

  if (loginForm){
    loginForm.addEventListener('submit', function(e){
      const email = loginForm.querySelector('input[name="email"]').value.trim();
      const pass = loginForm.querySelector('input[name="password"]').value;
      if (!/^\S+@\S+\.\S+$/.test(email) || pass.length < 1){
        e.preventDefault(); showAlert('E-mail e senha são obrigatórios.');
      }
    });
  }

  if (createForm){
    createForm.addEventListener('submit', function(e){
      const title = createForm.querySelector('input[name="title"]').value.trim();
      const price = parseFloat(createForm.querySelector('input[name="price"]').value);
      if (!title || !(price > 0)){
        e.preventDefault(); showAlert('Título e preço válido são obrigatórios.');
      }
    });
  }

  if (editForm){
    editForm.addEventListener('submit', function(e){
      const title = editForm.querySelector('input[name="title"]').value.trim();
      const price = parseFloat(editForm.querySelector('input[name="price"]').value);
      if (!title || !(price > 0)){
        e.preventDefault(); showAlert('Título e preço válido são obrigatórios.');
      }
    });
  }

  document.querySelectorAll('.buy-btn').forEach(btn=>{
    btn.addEventListener('click', ()=> {
      btn.textContent = 'Adicionado ✓';
      btn.disabled = true;
      btn.style.opacity = '0.8';
      setTimeout(()=>{ btn.textContent = 'Compre agora'; btn.disabled=false; btn.style.opacity='1'; }, 1200);
    });
  });
});
