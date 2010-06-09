{*
 * PessoaFisica => View de manipulação de dados da classe 'PessoaFisica'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">

					<input type="hidden" id="pessoa_id" name="pessoa_id" value="{$object->getPessoaId()}" />
					
					<div class="line">
						<label class="label" for="cpf">CPF</label>
						<div class="innerLine">
							<input type="text" disabled="disabled" class="input normal" id="cpf" name="cpf" value="{$object->getCpf()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="data_nascimento">Data de Nascimento</label>
						<div class="innerLine">
							<input type="text" disabled="disabled" class="input normal" id="data_nascimento" name="data_nascimento" value="{html_data values=$object->getDataNascimento()}" />
						</div>
					</div>
				</div>