{*
 * Pessoa => View de manipulação de dados da classe 'Pessoa'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$professor->getId()}" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="{$professor->getNome()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="email">email</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="email" name="email" maxlength="250" value="{$professor->getEmail()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="site">site</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="site" name="site" maxlength="250" value="{$professor->getSite()}" />
						</div>
					</div>
				</div>