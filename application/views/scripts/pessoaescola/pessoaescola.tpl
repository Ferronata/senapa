{*
 * PessoaEscola => View de manipulação de dados da classe 'PessoaEscola'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

					<input type="hidden" id="pessoa_escola_pessoa_fisica_pessoa_id" name="pessoa_escola_pessoa_fisica_pessoa_id" value="{$object->getPessoaEscolaPessoaFisicaPessoaId()}" />

					<div class="line">
						<label class="label required" for="pessoa_escola_matricula">Matrícula</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_matricula" name="pessoa_escola_matricula" maxlength="10" value="{$object->getPessoaEscolaMatricula()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="senha">Senha</label>
						<div class="innerLine">
							<input type="password" class="key input pequeno" id="senha" name="senha" maxlength="150" value="{crypt crypt=md5 action=decrypt value=$object->getSenha()}" />
						</div>
					</div>
