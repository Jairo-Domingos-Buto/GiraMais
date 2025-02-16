document.addEventListener('DOMContentLoaded', () => {
  const profileName = document.getElementById('profileName');
  const fullName = document.getElementById('fullName');
  const emailDetail = document.getElementById('emailDetail');
  const paymentPin = document.getElementById('paymentPin');
  const accountBalance = document.getElementById('accountBalance');
  const showPinBtn = document.getElementById('showPinBtn');

  // Generate a random 4-digit PIN
  const generatePIN = () => {
    return Math.floor(1000 + Math.random() * 9000).toString();
  };

  // Load existing profile data
  const loadProfileData = () => {
    const userData = JSON.parse(localStorage.getItem('userData') || '{}');
    
    // If no user data exists, create default profile
    if (Object.keys(userData).length === 0) {
      userData.nome = 'João Silva Santos';
      userData.email = 'joao.santos@capalanca.ao';
      userData.pin = generatePIN();
      userData.saldo = '5000.00';
      
      localStorage.setItem('userData', JSON.stringify(userData));
    }
    
    profileName.textContent = userData.nome;
    fullName.textContent = userData.nome;
    emailDetail.textContent = userData.email;
    paymentPin.textContent = '• • • •';
    accountBalance.textContent = `${userData.saldo} KZ`;

    // Store PIN in a data attribute for later use
    paymentPin.dataset.pin = userData.pin;
  };

  loadProfileData();

  // Show/Hide PIN functionality
  let isPinVisible = false;
  showPinBtn.addEventListener('click', () => {
    const pin = paymentPin.dataset.pin;
    
    if (!isPinVisible) {
      paymentPin.textContent = pin;
      showPinBtn.innerHTML = '<i class="material-icons">visibility_off</i>';
    } else {
      paymentPin.textContent = '• • • •';
      showPinBtn.innerHTML = '<i class="material-icons">visibility</i>';
    }
    
    isPinVisible = !isPinVisible;
  });

  // Edit profile button functionality
  const editProfileBtn = document.getElementById('editProfileBtn');
  editProfileBtn.addEventListener('click', () => {
    alert('Funcionalidade de edição em desenvolvimento.');
  });
});