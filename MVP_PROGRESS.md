# Progresso do MVP - Gestão de Frotas

## ✅ Concluído

### CRUDs

- [x] Motoristas (Drivers)
- [x] Veículos (Vehicles)
- [x] Controle de KM
- [x] Níveis de usuários e permissões
- [x] Policy de abastecimentos
- [x] Testes automatizados da policy
- [x] Factory completa de Fueling

### Regras de negócios

- [x] Não permitir exclusão de veículos/motoristas vinculados a abastecimento
- [x] Registro de quem autorizou o abastecimento (authorized_by)
- [ ] Validar KM no abastecimento para evitar que seja menor que o último abastecimento

## 🚧 Em andamento

- [x] Abastecimentos (Fuelings) - com autorização por gestor
- [x] Cálculo automático do custo total (litros * valor por litro)
- [x] Validação: hodômetro > último abastecimento
- [x] Listagem e filtros na tela de abastecimentos (`Fueling/Index`)
- [x] Tela de edição (`Fueling/Edit`)
- [x] Política de autorização por tipo de usuário (gate/policy)
- [ ] Tela de resumo mensal por veículo (km inicial/final)

## 📌 Próximas etapas

- [ ] Relação entre veículos e motoristas preservada (onDelete restrict)
- [ ] Exportação de relatórios exigidos pelo TCE
- [ ] Controle de manutenção (preventiva/corretiva)
- [ ] Controle por contrato de abastecimento (cartão)
- [ ] Notificações por vencimento de CNH
- [ ] Auditoria e histórico de alterações

### Sprint 5 – [Concluída em 2025-04-01]

✅ Implementado o módulo de Configurações para:

- Cadastro de Postos de Combustíveis (FuelStation)
  - Index, Create e Edit com validação
  - Utiliza componente Livewire + layout tradicional
  - Protegido por middleware `role:admin`
  - Seed e Factory criados

- Cadastro de Oficinas de Reparos (RepairShop)
  - Index, Create e Edit completos
  - Uso de Enum `RepairSpecialty` para especialidades
  - Select com validação e cast automático
  - Seed e Factory criados

🔄 O módulo de **usuários (User)** teve apenas a estrutura visual iniciada, com botões e placeholders de ações.

📌 Módulo de manutenção será iniciado na Sprint 6.
