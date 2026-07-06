<?php
require_once 'db.php';
require_once 'check_auth.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include_once 'admin_header.php';
?>

<div class="page-header-wrapper">
    <div class="page-header">
        <h1>Inquiry CRM</h1>
        <p>Manage customer relationships and project leads.</p>
    </div>
    <div style="width: 300px;">
        <input type="text" id="crmSearch" class="form-control crm-search-input" placeholder="🔍 Search clients or services..." 
               style="border-radius: 1rem; padding: 0.75rem 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-float);">
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table id="crmTable">
        <thead>
            <tr>
                <th>Status</th>
                <th>Client Details</th>
                <th>Service</th>
                <th>Received</th>
                <th style="text-align: right; width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                        $date = date('M j, Y', strtotime($row['created_at']));
                        $isPending = $row['status'] == 'Pending';
                        $statusClass = $isPending ? 'status-pending' : 'status-contacted';
                        $statusIcon = $isPending ? '⏳' : '✅';
                        $rowStyle = $isPending ? 'border-left: 4px solid var(--secondary);' : '';
                        
                        echo "<tr style='$rowStyle' class='crm-row' data-id='" . $row['id'] . "'>";
                        echo "<td>
                            <span class='status-pill $statusClass'>$statusIcon <span class='status-text'>" . $row['status'] . "</span></span>
                        </td>";
                        echo "<td>
                            <div style='font-weight: 800; color: var(--primary);'>" . htmlspecialchars($row['name']) . "</div>
                            <div style='font-size: 0.8125rem; color: var(--text-muted);'>" . htmlspecialchars($row['email']) . "</div>
                        </td>";
                        echo "<td><span style='background: #F1F5F9; padding: 0.4rem 0.8rem; border-radius: 0.75rem; font-size: 0.75rem; font-weight: 700; color: var(--primary);'>" . htmlspecialchars($row['service']) . "</span></td>";
                        echo "<td><div style='font-size: 0.875rem;'>$date</div></td>";
                        echo "<td style='text-align: right;'>
                            <div style='display: flex; justify-content: flex-end; gap: 0.5rem;'>
                                <button class='btn btn-view' onclick='viewInquiry(" . json_encode($row) . ")'>View</button>
                                <button class='btn btn-delete' onclick='confirmDelete(" . $row['id'] . ")' title='Delete Inquiry'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                            </div>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center; padding: 5rem;'>
                        <div style='font-size: 4rem; margin-bottom: 1rem;'>✨</div>
                        <div style='font-weight: 800; color: var(--primary); font-size: 1.5rem;'>Inbox is Clean</div>
                        <div style='color: var(--text-muted);'>No customer inquiries have been received yet.</div>
                    </td></tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='5' style='text-align: center; color: red;'>Database error.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</div>

<!-- Inquiry Detail Modal -->
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 2rem; border: none; overflow: hidden; background: none;">
            <div class="modal-glass-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
                    <div>
                        <h2 id="modalName" style="margin: 0; font-weight: 800; letter-spacing: -1px; color: var(--primary);">Client Name</h2>
                        <div id="modalEmail" style="color: var(--secondary); font-weight: 600;">client@example.com</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 0.5rem;">Service Requested</div>
                    <div id="modalService" style="font-weight: 700; color: var(--primary); background: #F1F5F9; display: inline-block; padding: 0.5rem 1rem; border-radius: 1rem;">Service Name</div>
                </div>

                <div style="margin-bottom: 2.5rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 0.5rem;">Message</div>
                    <div id="modalMessage" style="color: var(--text); line-height: 1.6; background: rgba(255,255,255,0.5); padding: 1.5rem; border-radius: 1.5rem; border: 1px solid var(--border);">
                        Full inquiry message content goes here...
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <div style="flex: 1;">
                        <input type="hidden" id="modalId">
                        <button type="button" id="markContactedBtn" onclick="updateStatus()" class="btn btn-primary" style="width: 100%;">Mark as Contacted</button>
                    </div>
                    <a id="replyBtn" href="#" class="btn" style="background: var(--primary); color: #fff; flex: 1;">Reply via Email</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .crm-row {
        transition: transform 0.3s ease, background 0.3s ease;
    }
    .crm-row:hover {
        transform: translateY(-3px);
        background-color: rgba(255, 184, 0, 0.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        z-index: 10;
        position: relative;
    }
    .crm-search-input:focus {
        box-shadow: 0 0 15px rgba(255, 184, 0, 0.4) !important;
        border-color: var(--secondary) !important;
    }
    .status-pill {
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending {
        background: rgba(255, 184, 0, 0.1);
        color: #B45309;
        border: 1px solid rgba(255, 184, 0, 0.2);
    }
    .status-contacted {
        background: rgba(30, 64, 175, 0.1);
        color: #1E40AF;
        border: 1px solid rgba(30, 64, 175, 0.2);
    }
    .btn-view {
        background: #F8FAFC;
        color: var(--primary);
        font-size: 0.75rem;
        padding: 0.5rem 1rem;
        border: 1px solid var(--border);
        border-radius: 0.75rem;
        transition: var(--transition);
    }
    .btn-view:hover {
        background: var(--primary);
        color: #fff;
        transform: scale(1.05);
    }
    .btn-delete {
        background: #FEF2F2;
        color: #EF4444;
        font-size: 0.75rem;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #FEE2E2;
        border-radius: 0.75rem;
        transition: var(--transition);
    }
    .btn-delete:hover {
        background: #EF4444;
        color: #fff;
        transform: scale(1.1);
    }
    .modal-glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 3rem;
        border-radius: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>

<script>
    let currentModal;
    const csrfToken = "<?= $_SESSION['csrf_token'] ?>";

    // Search Logic
    document.getElementById('crmSearch').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#crmTable tbody tr');
        
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Modal Logic
    function viewInquiry(data) {
        document.getElementById('modalName').textContent = data.name;
        document.getElementById('modalEmail').textContent = data.email;
        document.getElementById('modalService').textContent = data.service || 'General Inquiry';
        document.getElementById('modalMessage').innerHTML = data.message.replace(/\n/g, '<br>');
        document.getElementById('modalId').value = data.id;
        document.getElementById('replyBtn').href = 'mailto:' + data.email;
        
        // Hide button if already contacted
        document.getElementById('markContactedBtn').style.display = data.status === 'Contacted' ? 'none' : 'block';
        
        currentModal = new bootstrap.Modal(document.getElementById('inquiryModal'));
        currentModal.show();
    }

    // AJAX Status Update
    async function updateStatus() {
        const id = document.getElementById('modalId').value;
        const btn = document.getElementById('markContactedBtn');
        
        btn.disabled = true;
        btn.textContent = 'Updating...';

        const formData = new FormData();
        formData.append('id', id);
        formData.append('status', 'Contacted');
        formData.append('csrf_token', csrfToken);

        try {
            const response = await fetch('update_inquiry_status.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                // Update UI on the page
                const row = document.querySelector(`.crm-row[data-id="${id}"]`);
                if (row) {
                    const pill = row.querySelector('.status-pill');
                    pill.className = 'status-pill status-contacted';
                    pill.innerHTML = '✅ <span class="status-text">Contacted</span>';
                    row.style.borderLeft = 'none';
                }
                
                // Close modal
                currentModal.hide();
                
                // Optional: Show a success toast or alert
            } else {
                alert('Update failed: ' + result.message);
                btn.disabled = false;
                btn.textContent = 'Mark as Contacted';
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            alert('A system error occurred.');
            btn.disabled = false;
            btn.textContent = 'Mark as Contacted';
        }
    }

    // Delete Logic
    async function confirmDelete(id) {
        if (!confirm('Are you sure you want to delete this inquiry? This action cannot be undone.')) return;
        
        const row = document.querySelector(`.crm-row[data-id="${id}"]`);
        row.style.opacity = '0.5';
        row.style.pointerEvents = 'none';

        const formData = new FormData();
        formData.append('id', id);
        formData.append('csrf_token', csrfToken);

        try {
            const response = await fetch('delete_inquiry.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                row.style.transform = 'translateX(50px)';
                row.style.opacity = '0';
                setTimeout(() => row.remove(), 300);
            } else {
                alert('Delete failed: ' + result.message);
                row.style.opacity = '1';
                row.style.pointerEvents = 'auto';
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            alert('A system error occurred.');
            row.style.opacity = '1';
            row.style.pointerEvents = 'auto';
        }
    }
</script>

<?php include_once 'admin_footer.php'; ?>