namespace GestionePermessi
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            menuPrincipale = new MenuStrip();
            caricaFileCSVMastercomToolStripMenuItem = new ToolStripMenuItem();
            caricaFileCSVMastercomToolStripMenuItem1 = new ToolStripMenuItem();
            convertiTABInVIRGOLAToolStripMenuItem = new ToolStripMenuItem();
            togliSpaziInizialiEFinaliToolStripMenuItem = new ToolStripMenuItem();
            generaOutputFinaleToolStripMenuItem = new ToolStripMenuItem();
            DialogApriFileCSV = new OpenFileDialog();
            listCSV = new ListBox();
            listClear = new ListBox();
            lista_studenti = new ListBox();
            generaStruttura = new Button();
            listOutput = new ListBox();
            lbImport = new Label();
            label1 = new Label();
            label2 = new Label();
            label3 = new Label();
            tbDefaultPassword = new TextBox();
            label4 = new Label();
            DialogSalvaFileCSV = new SaveFileDialog();
            menuPrincipale.SuspendLayout();
            SuspendLayout();
            // 
            // menuPrincipale
            // 
            menuPrincipale.Items.AddRange(new ToolStripItem[] { caricaFileCSVMastercomToolStripMenuItem });
            menuPrincipale.Location = new Point(0, 0);
            menuPrincipale.Name = "menuPrincipale";
            menuPrincipale.Size = new Size(1305, 24);
            menuPrincipale.TabIndex = 0;
            menuPrincipale.Text = "menuStrip1";
            // 
            // caricaFileCSVMastercomToolStripMenuItem
            // 
            caricaFileCSVMastercomToolStripMenuItem.DropDownItems.AddRange(new ToolStripItem[] { caricaFileCSVMastercomToolStripMenuItem1, convertiTABInVIRGOLAToolStripMenuItem, togliSpaziInizialiEFinaliToolStripMenuItem, generaOutputFinaleToolStripMenuItem });
            caricaFileCSVMastercomToolStripMenuItem.Name = "caricaFileCSVMastercomToolStripMenuItem";
            caricaFileCSVMastercomToolStripMenuItem.Size = new Size(79, 20);
            caricaFileCSVMastercomToolStripMenuItem.Text = "Mastercom";
            // 
            // caricaFileCSVMastercomToolStripMenuItem1
            // 
            caricaFileCSVMastercomToolStripMenuItem1.Name = "caricaFileCSVMastercomToolStripMenuItem1";
            caricaFileCSVMastercomToolStripMenuItem1.Size = new Size(243, 22);
            caricaFileCSVMastercomToolStripMenuItem1.Text = "Carica file da Mastercom";
            caricaFileCSVMastercomToolStripMenuItem1.Click += caricaFileCSVMastercomToolStripMenuItem_Click;
            // 
            // convertiTABInVIRGOLAToolStripMenuItem
            // 
            convertiTABInVIRGOLAToolStripMenuItem.Enabled = false;
            convertiTABInVIRGOLAToolStripMenuItem.Name = "convertiTABInVIRGOLAToolStripMenuItem";
            convertiTABInVIRGOLAToolStripMenuItem.Size = new Size(243, 22);
            convertiTABInVIRGOLAToolStripMenuItem.Text = "Cambio carattere di separazione";
            convertiTABInVIRGOLAToolStripMenuItem.Click += convertiTABInVIRGOLAToolStripMenuItem_Click;
            // 
            // togliSpaziInizialiEFinaliToolStripMenuItem
            // 
            togliSpaziInizialiEFinaliToolStripMenuItem.Enabled = false;
            togliSpaziInizialiEFinaliToolStripMenuItem.Name = "togliSpaziInizialiEFinaliToolStripMenuItem";
            togliSpaziInizialiEFinaliToolStripMenuItem.Size = new Size(243, 22);
            togliSpaziInizialiEFinaliToolStripMenuItem.Text = "Rimozione spazi iniziali e finali";
            togliSpaziInizialiEFinaliToolStripMenuItem.Click += togliSpaziInizialiEFinaliToolStripMenuItem_Click;
            // 
            // generaOutputFinaleToolStripMenuItem
            // 
            generaOutputFinaleToolStripMenuItem.Enabled = false;
            generaOutputFinaleToolStripMenuItem.Name = "generaOutputFinaleToolStripMenuItem";
            generaOutputFinaleToolStripMenuItem.Size = new Size(243, 22);
            generaOutputFinaleToolStripMenuItem.Text = "Genera output finale";
            generaOutputFinaleToolStripMenuItem.Click += generaStruttura_Click;
            // 
            // DialogApriFileCSV
            // 
            DialogApriFileCSV.DefaultExt = "xls";
            DialogApriFileCSV.FileName = "openFileDialog1";
            DialogApriFileCSV.Filter = "File Mastercom|*.xls|Tutti i file|*.*";
            DialogApriFileCSV.Title = "Carica file Mastercom";
            DialogApriFileCSV.FileOk += DialogApriFileCSV_FileOk;
            // 
            // listCSV
            // 
            listCSV.FormattingEnabled = true;
            listCSV.ItemHeight = 15;
            listCSV.Location = new Point(12, 48);
            listCSV.Name = "listCSV";
            listCSV.Size = new Size(1281, 169);
            listCSV.TabIndex = 1;
            // 
            // listClear
            // 
            listClear.FormattingEnabled = true;
            listClear.ItemHeight = 15;
            listClear.Location = new Point(12, 254);
            listClear.Name = "listClear";
            listClear.Size = new Size(1281, 169);
            listClear.TabIndex = 3;
            // 
            // lista_studenti
            // 
            lista_studenti.FormattingEnabled = true;
            lista_studenti.ItemHeight = 15;
            lista_studenti.Location = new Point(12, 460);
            lista_studenti.Name = "lista_studenti";
            lista_studenti.Size = new Size(1281, 169);
            lista_studenti.TabIndex = 4;
            // 
            // generaStruttura
            // 
            generaStruttura.Location = new Point(968, 630);
            generaStruttura.Name = "generaStruttura";
            generaStruttura.Size = new Size(123, 33);
            generaStruttura.TabIndex = 5;
            generaStruttura.Text = "Genera Struttura";
            generaStruttura.UseVisualStyleBackColor = true;
            generaStruttura.Visible = false;
            generaStruttura.Click += generaStruttura_Click;
            // 
            // listOutput
            // 
            listOutput.FormattingEnabled = true;
            listOutput.ItemHeight = 15;
            listOutput.Location = new Point(12, 666);
            listOutput.Name = "listOutput";
            listOutput.Size = new Size(1281, 169);
            listOutput.TabIndex = 6;
            // 
            // lbImport
            // 
            lbImport.AutoSize = true;
            lbImport.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point);
            lbImport.Location = new Point(12, 24);
            lbImport.Name = "lbImport";
            lbImport.Size = new Size(301, 21);
            lbImport.TabIndex = 7;
            lbImport.Text = "Dati originali importati da MasterCom";
            lbImport.Click += label1_Click;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point);
            label1.Location = new Point(12, 230);
            label1.Name = "label1";
            label1.Size = new Size(256, 21);
            label1.TabIndex = 8;
            label1.Text = "Cambio carattere di separazione";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point);
            label2.Location = new Point(12, 436);
            label2.Name = "label2";
            label2.Size = new Size(248, 21);
            label2.TabIndex = 9;
            label2.Text = "Rimozione spazi iniziali e finali";
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point);
            label3.Location = new Point(12, 642);
            label3.Name = "label3";
            label3.Size = new Size(112, 21);
            label3.TabIndex = 10;
            label3.Text = "Output finale";
            label3.Click += label3_Click;
            // 
            // tbDefaultPassword
            // 
            tbDefaultPassword.Location = new Point(1046, 22);
            tbDefaultPassword.Name = "tbDefaultPassword";
            tbDefaultPassword.Size = new Size(247, 23);
            tbDefaultPassword.TabIndex = 11;
            tbDefaultPassword.Text = "anno2024";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Font = new Font("Segoe UI", 12F, FontStyle.Bold, GraphicsUnit.Point);
            label4.Location = new Point(834, 24);
            label4.Name = "label4";
            label4.Size = new Size(206, 21);
            label4.TabIndex = 12;
            label4.Text = "Password default genitori";
            // 
            // DialogSalvaFileCSV
            // 
            DialogSalvaFileCSV.DefaultExt = "csv";
            DialogSalvaFileCSV.FileName = "esporta_permessi_genitori.csv";
            DialogSalvaFileCSV.Filter = "File CSV|*.csv|Tutti i file|*.*";
            DialogSalvaFileCSV.Title = "Salve file CSV Permessi";
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(1305, 861);
            Controls.Add(label4);
            Controls.Add(tbDefaultPassword);
            Controls.Add(label3);
            Controls.Add(label2);
            Controls.Add(label1);
            Controls.Add(lbImport);
            Controls.Add(listOutput);
            Controls.Add(generaStruttura);
            Controls.Add(lista_studenti);
            Controls.Add(listClear);
            Controls.Add(listCSV);
            Controls.Add(menuPrincipale);
            MainMenuStrip = menuPrincipale;
            Name = "Form1";
            StartPosition = FormStartPosition.CenterScreen;
            Text = "Gestione elenchi genitori - studenti per permessi da MasterCom";
            menuPrincipale.ResumeLayout(false);
            menuPrincipale.PerformLayout();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private MenuStrip menuPrincipale;
        private ToolStripMenuItem caricaFileCSVMastercomToolStripMenuItem;
        private OpenFileDialog DialogApriFileCSV;
        private ListBox listCSV;
        private ToolStripMenuItem convertiTABInVIRGOLAToolStripMenuItem;
        private ListBox listClear;
        private ListBox lista_studenti;
        private ToolStripMenuItem caricaFileCSVMastercomToolStripMenuItem1;
        private ToolStripMenuItem togliSpaziInizialiEFinaliToolStripMenuItem;
        private Button generaStruttura;
        private ListBox listOutput;
        private Label lbImport;
        private Label label1;
        private Label label2;
        private Label label3;
        private ToolStripMenuItem generaOutputFinaleToolStripMenuItem;
        private TextBox tbDefaultPassword;
        private Label label4;
        private SaveFileDialog DialogSalvaFileCSV;
    }
}